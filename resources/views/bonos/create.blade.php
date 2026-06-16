@extends('layouts.app')

@section('contenido')

<h1>Nuevo Bono</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Trabajador</label>
                <input type="text" class="form-control" placeholder="Nombre del trabajador">
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" class="form-control">
            </div>

            <div class="mb-3">
                <label>Motivo</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Productividad">
            </div>

            <div class="mb-3">
                <label>Monto</label>
                <input type="number" class="form-control" placeholder="Monto del bono">
            </div>

            <button class="btn btn-success">
                Guardar
            </button>

            <a href="/bonos" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection