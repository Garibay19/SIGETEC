@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-gear-fill"
    style="color:#d4af37;"></i>

    Nueva Máquina

</h1>

<p class="text-muted">

    Registra una nueva máquina o equipo en el sistema.

</p>

</div>

<div class="card">

<div class="card-body">

    <form>

        <div class="mb-3">

            <label class="form-label">
                Nombre
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ejemplo: Máquina Recta">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Marca
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ejemplo: Juki">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Modelo
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ejemplo: DDL-8700">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Estado
            </label>

            <select class="form-control">

                <option>Operando</option>
                <option>En mantenimiento</option>
                <option>Fuera de servicio</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha de Adquisición
            </label>

            <input
            type="date"
            class="form-control">

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Guardar

        </button>

        <a href="/maquinaria"
        class="btn btn-secondary">

            <i class="bi bi-x-circle-fill"></i>
            Cancelar

        </a>

    </form>

</div>

</div>

@endsection
