@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-person-plus-fill"
    style="color:#d4af37;"></i>

    Nuevo Cliente

</h1>

<p class="text-muted">

    Registra un nuevo cliente en el sistema.

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
                Dirección
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ingrese la dirección">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Correo Electrónico
            </label>

            <input
            type="email"
            class="form-control"
            placeholder="correo@ejemplo.com">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Observaciones
            </label>

            <textarea
            class="form-control"
            rows="3"
            placeholder="Información adicional del cliente">
            </textarea>

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Guardar

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
