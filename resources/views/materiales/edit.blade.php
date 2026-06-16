@extends('layouts.app')

@section('contenido')

<h1>Editar Material</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre del material</label>
                <input type="text" class="form-control" value="Tela Mezclilla">
            </div>

            <div class="mb-3">
                <label>Categoría</label>
                <input type="text" class="form-control" value="Tela">
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="number" class="form-control" value="50">
            </div>

            <div class="mb-3">
                <label>Unidad de medida</label>
                <input type="text" class="form-control" value="Metros">
            </div>

            <div class="mb-3">
                <label>Proveedor</label>
                <input type="text" class="form-control" value="Textiles Puebla">
            </div>

            <button class="btn btn-success">
                Actualizar
            </button>

            <a href="/materiales" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection