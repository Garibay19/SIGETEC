@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Trabajador

</h1>

<p class="text-muted">

    Modifica la información del trabajador seleccionado.

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
            value="María López">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Teléfono
            </label>

            <input
            type="text"
            class="form-control"
            value="2411234567">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Puesto
            </label>

            <input
            type="text"
            class="form-control"
            value="Costurera">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Área Asignada
            </label>

            <input
            type="text"
            class="form-control"
            value="Confección">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Estatus
            </label>

            <select class="form-control">

                <option selected>Activo</option>
                <option>Inactivo</option>
                <option>Vacaciones</option>

            </select>

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Actualizar

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
