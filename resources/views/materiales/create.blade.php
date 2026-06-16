@extends('layouts.app')

@section('contenido')

<h1>Nuevo Material</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre del material</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Tela mezclilla">
            </div>

            <div class="mb-3">
                <label>Categoría</label>
                <input type="text" class="form-control" placeholder="Tela, hilo, botón, cierre">
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="number" class="form-control" placeholder="Cantidad disponible">
            </div>

            <div class="mb-3">
                <label>Unidad de medida</label>
                <input type="text" class="form-control" placeholder="Metros, piezas, rollos">
            </div>

            <div class="mb-3">
                <label>Proveedor</label>
                <input type="text" class="form-control" placeholder="Nombre del proveedor">
            </div>

            <button class="btn btn-success">Guardar</button>
            <a href="/materiales" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

@endsection