@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Editar Trabajador
    </h1>
    <p class="text-muted">
        Modifica la información del trabajador seleccionado.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Formulario enlazado a la ruta update con método PUT y autocompletado apagado -->
        <form action="{{ route('trabajadores.update', $trabajador->id_trabajador) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <!-- CORREGIDO: value dinámico con name="nombre" y obligatorio -->
                <input type="text" name="nombre" class="form-control" value="{{ $trabajador->nombre }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <!-- CORREGIDO: value dinámico con name="telefono" -->
                <input type="text" name="telefono" class="form-control" value="{{ $trabajador->telefono }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Puesto</label>
                <!-- CORREGIDO: value dinámico con name="puesto" -->
                <input type="text" name="puesto" class="form-control" value="{{ $trabajador->puesto }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Área Asignada</label>
                <!-- CORREGIDO: value dinámico con name="area_asignada" -->
                <input type="text" name="area_asignada" class="form-control" value="{{ $trabajador->area_asignada }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Estatus</label>
                <!-- CORREGIDO: name="estatus" asignado y marcador inteligente select -->
                <select name="estatus" class="form-control" required>
                    <option value="Activo" {{ $trabajador->estatus == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $trabajador->estatus == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    <option value="Vacaciones" {{ $trabajador->estatus == 'Vacaciones' ? 'selected' : '' }}>Vacaciones</option>
                </select>
            </div>

            <!-- CORREGIDO: Atributo type="submit" para activar el proceso -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i>
                Actualizar
            </button>

            <a href="/trabajadores" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i>
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
