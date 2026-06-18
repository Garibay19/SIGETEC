@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-person-plus-fill"
    style="color:#d4af37;"></i>

    Nuevo Trabajador

</h1>

<p class="text-muted">

    Registra un nuevo trabajador en el sistema.

</p>

</div>

<div class="card">

<div class="card-body">

    <form>

        <div class="mb-3">

            <label class="form-label">
                Nombre Completo
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ingrese el nombre completo">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Teléfono
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ingrese el teléfono">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Puesto
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ejemplo: Costurera">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Área Asignada
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ejemplo: Confección">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Estatus
            </label>

            <select class="form-control">

                <option>Activo</option>
                <option>Inactivo</option>
                <option>Vacaciones</option>

            </select>

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Guardar

        </button>

        <a href="/trabajadores"
        class="btn btn-secondary">

            <i class="bi bi-x-circle-fill"></i>
            Cancelar

        </a>

    </form>

</div>

</div>

@endsection
