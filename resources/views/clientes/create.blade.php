@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-person-plus-fill" style="color:#d4af37;"></i>
        Nuevo Cliente
    </h1>
    <p class="text-muted">
        Registra un nuevo cliente en el sistema.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- Formulario enlazado al controlador con método POST y autocompletado apagado -->
        <form action="{{ route('clientes.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <!-- CORREGIDO: Se cambió name="nombre" por name="nombre_completo" para que coincida con el controlador -->
                <input type="text" name="nombre_completo" class="form-control" placeholder="Ingrese el nombre completo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono">
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección">
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                ="correo" -->
<input type="email" name="correo" class="form-control" placeholder="correo@ejemplo.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="3" placeholder="Información adicional del cliente"></textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i>
                Guardar
            </button>

            <a href="/clientes" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i>
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
