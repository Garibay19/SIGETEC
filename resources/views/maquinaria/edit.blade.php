@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Máquina

</h1>

<p class="text-muted">

    Modifica la información de la máquina seleccionada.

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
            value="Máquina Recta">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Marca
            </label>

            <input
            type="text"
            class="form-control"
            value="Juki">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Modelo
            </label>

            <input
            type="text"
            class="form-control"
            value="DDL-8700">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Estado
            </label>

            <select class="form-control">

                <option selected>Operando</option>
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
            class="form-control"
            value="2025-03-10">

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Actualizar

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
