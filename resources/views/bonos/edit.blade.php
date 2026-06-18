@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Bono

</h1>

<p class="text-muted">

    Modifica la información del bono seleccionado.

</p>

</div>

<div class="card">

<div class="card-body">

    <form>

        <div class="mb-3">

            <label class="form-label">
                Trabajador
            </label>

            <input
            type="text"
            class="form-control"
            value="María López">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha
            </label>

            <input
            type="date"
            class="form-control"
            value="2026-06-15">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Motivo
            </label>

            <input
            type="text"
            class="form-control"
            value="Productividad">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Monto
            </label>

            <input
            type="number"
            class="form-control"
            value="500">

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Actualizar

        </button>

        <a href="/bonos"
        class="btn btn-secondary">

            <i class="bi bi-x-circle-fill"></i>
            Cancelar

        </a>

    </form>

</div>

</div>

@endsection
