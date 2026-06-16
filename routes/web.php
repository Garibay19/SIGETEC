<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/clientes', function () {
    return view('clientes.index');
});

Route::get('/clientes/create', function () {
    return view('clientes.create');
});

Route::get('/clientes/edit', function () {
    return view('clientes.edit');
});

Route::get('/pedidos', function () {
    return view('pedidos.index');
});

Route::get('/pedidos/create', function () {
    return view('pedidos.create');
});

Route::get('/pedidos/edit', function () {
    return view('pedidos.edit');
});

Route::get('/pagos', function () {
    return view('pagos.index');
});

Route::get('/pagos/create', function () {
    return view('pagos.create');
});

Route::get('/pagos/edit', function () {
    return view('pagos.edit');
});

Route::get('/trabajadores', function () {
    return view('trabajadores.index');
});

Route::get('/trabajadores/create', function () {
    return view('trabajadores.create');
});

Route::get('/trabajadores/edit', function () {
    return view('trabajadores.edit');
});

Route::get('/bonos', function () {
    return view('bonos.index');
});

Route::get('/bonos/create', function () {
    return view('bonos.create');
});

Route::get('/bonos/edit', function () {
    return view('bonos.edit');
});

Route::get('/materiales', function () {
    return view('materiales.index');
});

Route::get('/materiales/create', function () {
    return view('materiales.create');
});

Route::get('/materiales/edit', function () {
    return view('materiales.edit');
});

Route::get('/maquinaria', function () {
    return view('maquinaria.index');
});

Route::get('/maquinaria/create', function () {
    return view('maquinaria.create');
});

Route::get('/maquinaria/edit', function () {
    return view('maquinaria.edit');
});

Route::get('/reportes', function () {
    return view('reportes.index');
});

Route::get('/reportes/create', function () {
    return view('reportes.create');
});

Route::get('/reportes/edit', function () {
    return view('reportes.edit');
});

Route::get('/usuarios', function () {
    return view('usuarios.index');
});

Route::get('/usuarios/create', function () {
    return view('usuarios.create');
});

Route::get('/usuarios/edit', function () {
    return view('usuarios.edit');
});
/*cuando entre a http://127.0.0.1:8000
monstrara: dashboard/index.blade.php*/