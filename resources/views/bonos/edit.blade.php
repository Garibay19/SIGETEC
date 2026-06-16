@extends('layouts.app')

@section('contenido')

<h1>Editar Bono</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Trabajador</label>
                <input type="text" class="form-control" value="María López">
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" class="form-control" value="2026-06-15">
            </div>

            <div class="mb-3">
                <label>Motivo</label>
                <input type="text" class="form-control" value="Productividad">
            </div>

            <div class="mb-3">
                <label>Monto</label>
                <input type="number" class="form-control" value="500">
            </div>

            <button class="btn btn-success">
                Actualizar
            </button>

            <a href="/bonos" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection