<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // SOPORTE DE MATEMÁTICA EN BASE DE DATOS
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\BonoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaquinariaController;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pago;
use App\Models\Bono;
use App\Models\Material;
use App\Models\Maquinaria;

// 1. Pantalla de inicio (Login)
Route::get('/', function () {
    return view('auth.login');
});

// 2. Dashboard (Calcula dinámicamente las 4 tarjetas desde la Base de Datos)
Route::get('/dashboard', function () {
    $totalClientes = Cliente::count();
    $pedidosPendientes = Pedido::whereIn('estado', ['Pendiente', 'En proceso'])->count();
    $pagosPendientes = Pedido::where('saldo_pendiente', '>', 0)->count();
    
    // Calcula la suma matemática real de todos los abonos del mes actual en MySQL
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

Route::get('/clientes/create', function () {
    return view('clientes.create');
});

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
Route::get('/trabajadores/create', function () {
    return view('trabajadores.create');
});

Route::post('/trabajadores/guardar', [App\Http\Controllers\TrabajadorController::class, 'store'])->name('trabajadores.store');
Route::get('/trabajadores/{id}/edit', [App\Http\Controllers\TrabajadorController::class, 'edit'])->name('trabajadores.edit');
Route::put('/trabajadores/{id}', [App\Http\Controllers\TrabajadorController::class, 'update'])->name('trabajadores.update');

// 7. MÓDULO DE BONOS (CON CALCULO ESTILO EXCEL)
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

// 8. MÓDULO DE MATERIALES (INVENTARIO DINÁMICO)
Route::get('/materiales', function () {
    $materiales = Material::orderBy('id_material', 'desc')->get();
    return view('materiales.index', compact('materiales'));
});

Route::get('/materiales/create', function () {
    return view('materiales.create');
});

Route::post('/materiales/guardar', [MaterialController::class, 'store'])->name('materiales.store');
Route::get('/materiales/{id}/edit', [MaterialController::class, 'edit'])->name('materiales.edit');
Route::put('/materiales/{id}', [MaterialController::class, 'update'])->name('materiales.update');
Route::delete('/materiales/{id}', [MaterialController::class, 'destroy'])->name('materiales.destroy');

// 9. MÓDULO DE MAQUINARIA (GESTIÓN DE ACTIVOS DEL TALLER)
Route::get('/maquinaria', function () {
    $maquinarias = Maquinaria::orderBy('id_maquinaria', 'desc')->get();
    return view('maquinaria.index', compact('maquinarias'));
});

Route::get('/maquinaria/create', function () {
    return view('maquinaria.create');
});

Route::post('/maquinaria/guardar', [MaquinariaController::class, 'store'])->name('maquinaria.store');
Route::get('/maquinaria/{id}/edit', [MaquinariaController::class, 'edit'])->name('maquinaria.edit');
Route::put('/maquinaria/{id}', [MaquinariaController::class, 'update'])->name('maquinaria.update');
Route::delete('/maquinaria/{id}', [MaquinariaController::class, 'destroy'])->name('maquinaria.destroy');


// MÓDULOS EN DESARROLLO (VISTAS ESTÁTICAS DE TU COMPAÑERO - CORREGIDO SIN DUPLICADOS)
// 10. MÓDULO DE REPORTES (FINANZAS Y CONTROL EN TIEMPO REAL)
Route::get('/reportes', function () {
    // ---- 1. SECCIÓN DE VENTAS (Monto total pactado en contratos/pedidos) ----
    $ventasHoy = App\Models\Pedido::whereDate('fecha_pedido', date('Y-m-d'))->sum('total');
    
    $ventasSemana = App\Models\Pedido::whereBetween('fecha_pedido', [
        \Carbon\Carbon::now()->startOfWeek(), 
        \Carbon\Carbon::now()->endOfWeek()
    ])->sum('total');
    
    $ventasMes = App\Models\Pedido::whereMonth('fecha_pedido', date('m'))
                                  ->whereYear('fecha_pedido', date('Y'))
                                  ->sum('total');
                                  
    $ventasAno = App\Models\Pedido::whereYear('fecha_pedido', date('Y'))->sum('total');

    // ---- 2. SECCIÓN DE GANANCIAS (Dinero real cobrado en caja mediante abonos) ----
    $gananciaSemana = App\Models\Pago::whereBetween('fecha_pago', [
        \Carbon\Carbon::now()->startOfWeek(), 
        \Carbon\Carbon::now()->endOfWeek()
    ])->sum('abono');

    $gananciaMes = App\Models\Pago::whereMonth('fecha_pago', date('m'))
                                  ->whereYear('fecha_pago', date('Y'))
                                  ->sum('abono');

    $gananciaAno = App\Models\Pago::whereYear('fecha_pago', date('Y'))->sum('abono');

    // ---- 3. CÁLCULO DE GASTOS AUTOMÁTICOS (Inversión acumulada en bonos comerciales a trabajadores) ----
    $gastosSemana = App\Models\Bono::whereBetween('created_at', [
        \Carbon\Carbon::now()->startOfWeek(), 
        \Carbon\Carbon::now()->endOfWeek()
    ])->sum('monto_bono');

    $gastosMes = App\Models\Bono::whereMonth('created_at', date('m'))
                                ->whereYear('created_at', date('Y'))
                                ->sum('monto_bono');

    $gastosAno = App\Models\Bono::whereYear('created_at', date('Y'))->sum('monto_bono');

    // ---- 4. GRAN TOTAL NETO FINANCIERO ----
    $gananciaNetaTotal = $gananciaAno - $gastosAno;

    // ---- 5. RESUMEN GENERAL DE INDICADORES OPERATIVOS ----
    $pedidosCompletados = App\Models\Pedido::where('estado', 'Terminado')->count();
    $pedidosPendientes = App\Models\Pedido::whereIn('estado', ['Pendiente', 'En proceso'])->count();
    $pedidosCancelados = App\Models\Pedido::where('estado', 'Cancelado')->count(); // Si no manejan este estado, marcará 0 automáticamente
    $trabajadoresActivos = App\Models\Trabajador::where('estatus', 'Activo')->count();
    $bonosEntregados = App\Models\Bono::where('cumplimiento', 'Cumple')->count();
    $usuariosRegistrados = App\Models\Cliente::count(); // Cuenta tus clientes como usuarios del flujo principal

    return view('reportes.index', compact(
        'gananciaNetaTotal', 'ventasHoy', 'ventasSemana', 'ventasMes', 'ventasAno',
        'gastosSemana', 'gastosMes', 'gastosAno', 'gananciaSemana', 'gananciaMes', 'gananciaAno',
        'pedidosCompletados', 'pedidosPendientes', 'pedidosCancelados', 'trabajadoresActivos', 'bonosEntregados', 'usuariosRegistrados'
    ));
});

Route::get('/reportes/create', function () { return view('reportes.create'); });
Route::get('/reportes/edit', function () { return view('reportes.edit'); });
Route::get('/usuarios', function () { return view('usuarios.index'); });
Route::get('/usuarios/create', function () { return view('usuarios.create'); });
Route::get('/usuarios/edit', function () { return view('usuarios.edit'); });
