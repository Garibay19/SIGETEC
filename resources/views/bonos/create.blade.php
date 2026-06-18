@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-cash-coin"
    style="color:#d4af37;"></i>

    Nuevo Bono

</h1>

<p class="text-muted">

    Registra un bono para un trabajador.

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
            placeholder="Nombre del trabajador">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha
            </label>

            <input
            type="date"
            class="form-control">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Motivo
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ejemplo: Productividad, puntualidad, cumplimiento de metas">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Monto
            </label>

            <input
            type="number"
            class="form-control"
            placeholder="Monto del bono">

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Guardar

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
