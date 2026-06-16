@extends('layouts.app')

@section('contenido')

<h1>Nuevo Trabajador</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre completo</label>
                <input type="text" class="form-control" placeholder="Ingrese el nombre completo">
            </div>

            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" class="form-control" placeholder="Ingrese el teléfono">
            </div>

            <div class="mb-3">
                <label>Puesto</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Costurera">
            </div>

            <div class="mb-3">
                <label>Área asignada</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Confección">
            </div>

            <div class="mb-3">
                <label>Estatus</label>

                <select class="form-control">
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>

            </div>

            <button class="btn btn-success">
                Guardar
            </button>

            <a href="/trabajadores" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection