<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // SOPORTE DE MATEMÁTICA EN BASE DE DATOS
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\BonoController;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pago;
use App\Models\Bono;

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
    $clientes = Cliente::all();
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

// CORREGIDO: Ruta para eliminar trabajadores añadida
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

// Ruta dinámica para cargar la pantalla de editar con el ID del bono semanal
Route::get('/bonos/{id}/edit', [BonoController::class, 'edit'])->name('bonos.edit');

// CORREGIDO: Ruta para actualizar la producción por días en la base de datos
Route::put('/bonos/{id}', [BonoController::class, 'update'])->name('bonos.update');

// CORREGIDO: Ruta para eliminar el registro semanal cuando cierres caja
Route::delete('/bonos/{id}', [BonoController::class, 'destroy'])->name('bonos.destroy');


// MÓDULOS EN DESARROLLO (VISTAS ESTÁTICAS DE TU COMPAÑERO)
Route::get('/materiales', function () { return view('materiales.index'); });
Route::get('/materiales/create', function () { return view('materiales.create'); });
Route::get('/materiales/edit', function () { return view('materiales.edit'); });
Route::get('/maquinaria', function () { return view('maquinaria.index'); });
Route::get('/maquinaria/create', function () { return view('maquinaria.create'); });
Route::get('/maquinaria/edit', function () { return view('maquinaria.edit'); });
Route::get('/reportes', function () { return view('reportes.index'); });
Route::get('/reportes/create', function () { return view('reportes.create'); });
Route::get('/reportes/edit', function () { return view('reportes.edit'); });
Route::get('/usuarios', function () { return view('usuarios.index'); });
Route::get('/usuarios/create', function () { return view('usuarios.create'); });
Route::get('/usuarios/edit', function () { return view('usuarios.edit'); });
