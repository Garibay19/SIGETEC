@extends('layouts.app')

@section('contenido')

<h1>Editar Trabajador</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre completo</label>
                <input type="text" class="form-control" value="María López">
            </div>

            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" class="form-control" value="2411234567">
            </div>

            <div class="mb-3">
                <label>Puesto</label>
                <input type="text" class="form-control" value="Costurera">
            </div>

            <div class="mb-3">
                <label>Área asignada</label>
                <input type="text" class="form-control" value="Confección">
            </div>

            <div class="mb-3">
                <label>Estatus</label>

                <select class="form-control">
                    <option selected>Activo</option>
                    <option>Inactivo</option>
                </select>

            </div>

            <button class="btn btn-success">
                Actualizar
            </button>

            <a href="/trabajadores" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection