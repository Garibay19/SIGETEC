@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-person-plus-fill" style="color:#d4af37;"></i>
        Nuevo Trabajador
    </h1>
    <p class="text-muted">
        Registra un nuevo trabajador en el sistema.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Enlazado a la ruta del backend con token de seguridad y autocompletado apagado -->
        <form action="{{ route('trabajadores.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <!-- CORREGIDO: Agregado name="nombre" y marcado como requerido -->
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre completo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <!-- CORREGIDO: Agregado name="telefono" -->
                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono">
            </div>

            <div class="mb-3">
                <label class="form-label">Puesto</label>
                <!-- CORREGIDO: Agregado name="puesto" -->
                <input type="text" name="puesto" class="form-control" placeholder="Ejemplo: Costurera">
            </div>

            <div class="mb-3">
                <label class="form-label">Área Asignada</label>
                <!-- CORREGIDO: Agregado name="area_asignada" -->
                <input type="text" name="area_asignada" class="form-control" placeholder="Ejemplo: Confección">
            </div>

            <div class="mb-3">
                <label class="form-label">Estatus</label>
                <!-- CORREGIDO: Agregado name="estatus" al menú desplegable -->
                <select name="estatus" class="form-control" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                    <option value="Vacaciones">Vacaciones</option>
                </select>
            </div>

            <!-- CORREGIDO: Agregado type="submit" para activar el proceso de envío -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i>
                Guardar
            </button>

            <a href="/trabajadores" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i>
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
