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

        <!-- CORREGIDO: Ruta agregada, método POST, token de seguridad y autocompletado desactivado -->
        <form action="{{ route('clientes.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <!-- CORREGIDO: Agregado name="nombre" y required -->
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre completo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <!-- CORREGIDO: Agregado name="telefono" -->
                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono">
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <!-- CORREGIDO: Agregado name="direccion" -->
                <input type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección">
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <!-- CORREGIDO: Agregado name="email" -->
                <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <!-- Nota: Este campo se queda libre ya que tu backend actual no procesa observaciones por ahora -->
                <textarea class="form-control" rows="3" placeholder="Información adicional del cliente"></textarea>
            </div>

            <!-- CORREGIDO: Agregado type="submit" para procesar el envío -->
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
