<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\BonoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\UsuarioController;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pago;
use App\Models\Bono;
use App\Models\Material;
use App\Models\Maquinaria;
use App\Models\User;

// 1. PANTALLA DE INICIO Y PROCESAMIENTO (LOGIN)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

// PROCESAR INICIO DE SESIÓN REAL (Acción POST del formulario)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ], [
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo no es válido.',
        'password.required' => 'La contraseña es obligatoria.',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
    ])->onlyInput('email');
})->name('login.post');


// GRUPO DE SEGURIDAD MÁXIMA
Route::middleware(['auth', 'no.invitado'])->group(function () {


    // CERRAR SESIÓN (LOGOUT)
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // 2. DASHBOARD
    Route::get('/dashboard', function () {
        $totalClientes = Cliente::count();
        $pedidosPendientes = Pedido::whereIn('estado', ['Pendiente', 'En proceso'])->count();
        $pagosPendientes = Pedido::where('saldo_pendiente', '>', 0)->count();
        $gananciaMes = Pago::whereMonth('fecha_pago', date('m'))
                            ->whereYear('fecha_pago', date('Y'))
                            ->sum('abono'); 

        return view('dashboard.index', compact('totalClientes', 'pedidosPendientes', 'pagosPendientes', 'gananciaMes'));
    });

    // 3. MÓDULO DE CLIENTES
    Route::get('/clientes', function () {
        $clientes = Cliente::orderBy('id_cliente', 'desc')->get();
        return view('clientes.index', compact('clientes'));
    });
    Route::get('/clientes/create', function () { return view('clientes.create'); });
    Route::post('/clientes/guardar', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    // 4. MÓDULO DE PEDIDOS
    Route::get('/pedidos', function () {
        $pedidos = Pedido::with('cliente')->get();
        return view('pedidos.index', compact('pedidos'));
    });
    Route::post('/pedidos/guardar', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
    Route::get('/pedidos/create', function () {
        $clientes = Cliente::all();
        return view('pedidos.create', compact('clientes'));
    });
    Route::get('/pedidos/{id}/edit', [PedidoController::class, 'edit'])->name('pedidos.edit');
    Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->name('pedidos.update');

        // 5. MÓDULO DE PAGOS
    Route::get('/pagos', function () {
        $pagosConsolidados = Pago::with('pedido.cliente')
            ->select('id_pedido', 
                DB::raw('MAX(id_pago) as id_pago'), 
                DB::raw('MAX(fecha_pago) as fecha_pago'), 
                DB::raw('MAX(monto_total_pedido) as monto_total_pedido'), 
                DB::raw('SUM(abono) as total_abonado'), 
                DB::raw('MIN(saldo_restante) as ultimo_saldo'), 
                DB::raw('MAX(metodo_pago) as metodo_pago'),
                DB::raw('MAX(estado) as estado')
            )
            ->groupBy('id_pedido')
            ->orderBy('id_pago', 'desc')
            ->get();

        $pagos = $pagosConsolidados->map(function($pago) {
            $pago->abono = $pago->total_abonado;
            $pago->saldo_restante = $pago->ultimo_saldo;
            return $pago;
        });
        return view('pagos.index', compact('pagos'));
    });
    Route::get('/pagos/create', function () {
        $pedidos = Pedido::with('cliente')->where('saldo_pendiente', '>', 0)->get();
        return view('pagos.create', compact('pedidos'));
    });
    Route::post('/pagos/guardar', [PagoController::class, 'store'])->name('pagos.store');
    Route::get('/pagos/{id}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
    Route::put('/pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');

    // 6. MÓDULO DE TRABAJADORES
    Route::get('/trabajadores', function () {
        $trabajadores = App\Models\Trabajador::all();
        return view('trabajadores.index', compact('trabajadores'));
    });
    Route::delete('/trabajadores/{id}', [App\Http\Controllers\TrabajadorController::class, 'destroy'])->name('trabajadores.destroy');
    Route::get('/trabajadores/create', function () { return view('trabajadores.create'); });
    Route::post('/trabajadores/guardar', [App\Http\Controllers\TrabajadorController::class, 'store'])->name('trabajadores.store');
    Route::get('/trabajadores/{id}/edit', [App\Http\Controllers\TrabajadorController::class, 'edit'])->name('trabajadores.edit');
    Route::put('/trabajadores/{id}', [App\Http\Controllers\TrabajadorController::class, 'update'])->name('trabajadores.update');

    // 7. MÓDULO DE BONOS
    Route::get('/bonos', function () {
        $bonos = Bono::with('trabajador')->get();
        return view('bonos.index', compact('bonos'));
    });
    Route::get('/bonos/create', function () {
        $trabajadores = App\Models\Trabajador::where('estatus', 'Activo')->get();
        return view('bonos.create', compact('trabajadores'));
    });
    Route::post('/bonos/guardar', [BonoController::class, 'store'])->name('bonos.store');
    Route::get('/bonos/{id}/edit', [BonoController::class, 'edit'])->name('bonos.edit');
    Route::put('/bonos/{id}', [BonoController::class, 'update'])->name('bonos.update');
    Route::delete('/bonos/{id}', [BonoController::class, 'destroy'])->name('bonos.destroy');

    // 8. MÓDULO DE MATERIALES
    Route::get('/materiales', function () {
        $materiales = Material::orderBy('id_material', 'desc')->get();
        return view('materiales.index', compact('materiales'));
    });
    Route::get('/materiales/create', function () { return view('materiales.create'); });
    Route::post('/materiales/guardar', [MaterialController::class, 'store'])->name('materiales.store');
    Route::get('/materiales/{id}/edit', [MaterialController::class, 'edit'])->name('materiales.edit');
    Route::put('/materiales/{id}', [MaterialController::class, 'update'])->name('materiales.update');
    Route::delete('/materiales/{id}', [MaterialController::class, 'destroy'])->name('materiales.destroy');

    // 9. MÓDULO DE MAQUINARIA
    Route::get('/maquinaria', function () {
        $maquinarias = Maquinaria::orderBy('id_maquinaria', 'desc')->get();
        return view('maquinaria.index', compact('maquinarias'));
    });
    Route::get('/maquinaria/create', function () { return view('maquinaria.create'); });
    Route::post('/maquinaria/guardar', [MaquinariaController::class, 'store'])->name('maquinaria.store');
    Route::get('/maquinaria/{id}/edit', [MaquinariaController::class, 'edit'])->name('maquinaria.edit');
    Route::put('/maquinaria/{id}', [MaquinariaController::class, 'update'])->name('maquinaria.update');
    Route::delete('/maquinaria/{id}', [MaquinariaController::class, 'destroy'])->name('maquinaria.destroy');
   
    // 9.5 MÓDULO DE USUARIOS (Vista de consulta)
    Route::get('/usuarios', function () {
        $usuarios = \App\Models\User::orderBy('id', 'desc')->get();
        return view('usuarios.index', compact('usuarios'));
    });
        // Escritura Usuarios (Solo Administradores y Superadministradores)
        Route::get('/usuarios/create', function () { return view('usuarios.create'); });
        Route::post('/usuarios/guardar', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    // 10. MÓDULO DE REPORTES
    Route::get('/reportes', function () {
        $ventasHoy = Pedido::whereDate('fecha_pedido', date('Y-m-d'))->sum('total');
        $ventasSemana = Pedido::whereBetween('fecha_pedido', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->sum('total');
        $ventasMes = Pedido::whereMonth('fecha_pedido', date('m'))->whereYear('fecha_pedido', date('Y'))->sum('total');
        $ventasAno = Pedido::whereYear('fecha_pedido', date('Y'))->sum('total');
        $gananciaSemana = Pago::whereBetween('fecha_pago', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->sum('abono');
        $gananciaMes = Pago::whereMonth('fecha_pago', date('m'))->whereYear('fecha_pago', date('Y'))->sum('abono');
        $gananciaAno = Pago::whereYear('fecha_pago', date('Y'))->sum('abono');
        $gastosSemana = Bono::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->sum('monto_bono');
        
        $gastosMes = Bono::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('monto_bono');
        $gastosAno = Bono::whereYear('created_at', date('Y'))->sum('monto_bono');
        $gananciaNetaTotal = $gananciaAno - $gastosAno;

        $pedidosCompletados = Pedido::where('estado', 'Completado')->count();
        $pedidosPendientes = Pedido::where('estado', 'Pendiente')->count();
        $pedidosCancelados = Pedido::where('estado', 'Cancelado')->count();

        $trabajadoresActivos = \App\Models\Trabajador::where('estatus', 'Activo')->count();
        $bonosEntregados = Bono::count();
        $usuariosRegistrados = User::count();
        
        return view('reportes.index', compact(
            'ventasHoy', 
            'ventasSemana', 
            'ventasMes', 
            'ventasAno', 
            'gananciaSemana', 
            'gananciaMes', 
            'gananciaAno', 
            'gastosSemana', 
            'gastosMes', 
            'gastosAno', 
            'gananciaNetaTotal',
            'pedidosCompletados',
            'pedidosPendientes',
            'pedidosCancelados',
            'trabajadoresActivos',
            'bonosEntregados',
            'usuariosRegistrados'
        ));
    });

    // 11. MÓDULO DE PRENDAS (Vista de consulta independiente para todos los logueados)
    Route::get('/prendas', function () {
        $prendas = \App\Models\Prenda::orderBy('id_prenda', 'desc')->get();
        return view('prendas.index', compact('prendas'));
    });

    // ======================================================================
    // SECCIÓN DE ESCRITURA DE PRENDAS (Bloqueado para el rol Invitado)
    // ======================================================================
    Route::middleware(['no.invitado'])->group(function () {
        Route::get('/prendas/create', function () { return view('prendas.create'); });
        Route::post('/prendas/guardar', [\App\Http\Controllers\PrendaController::class ?: 'App\Http\Controllers\PrendaController', 'store'])->name('prendas.store');
        Route::delete('/prendas/{id}', [\App\Http\Controllers\PrendaController::class ?: 'App\Http\Controllers\PrendaController', 'destroy'])->name('prendas.destroy');
    });

}); // Cierre definitivo global del archivo (cierra el grupo 'auth' general)
