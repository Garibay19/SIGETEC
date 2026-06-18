@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Cliente

</h1>

<p class="text-muted">

    Modifica la información del cliente seleccionado.

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
            value="Juan Pérez">

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
                Dirección
            </label>

            <input
            type="text"
            class="form-control"
            value="Apizaco, Tlaxcala">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Correo Electrónico
            </label>

            <input
            type="email"
            class="form-control"
            value="juan@gmail.com">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Observaciones
            </label>

            <textarea
            class="form-control"
            rows="3">Cliente frecuente</textarea>

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Actualizar

        </button>

        <a href="/clientes"
        class="btn btn-secondary">

            <i class="bi bi-x-circle-fill"></i>
            Cancelar

        </a>

    </form>

</div>

</div>

@endsection
