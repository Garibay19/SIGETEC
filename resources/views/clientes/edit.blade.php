@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Editar Cliente
    </h1>
    <p class="text-muted">
        Modifica la información del cliente seleccionado.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Formulario enlazado a la ruta dinámica update, con método seguro PUT y autocomplete apagado -->
        <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <!-- CORREGIDO: value dinámico con name="nombre" y obligatorio -->
                <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <!-- CORREGIDO: value dinámico con name="telefono" -->
                <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <!-- CORREGIDO: value dinámico con name="direccion" -->
                <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <!-- CORREGIDO: value dinámico con name="email" -->
                <input type="email" name="email" class="form-control" value="{{ $cliente->email }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <!-- CORREGIDO: Contenido dinámico cargado dentro del textarea con name="observaciones" -->
                <textarea name="observaciones" class="form-control" rows="3">{{ $cliente->observaciones }}</textarea>
            </div>

            <!-- CORREGIDO: type="submit" para que el botón procese los cambios en el controlador -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i>
                Actualizar
            </button>

            <a href="/clientes" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i>
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
