@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Editar Máquina
    </h1>
    <p class="text-muted">
        Modifica la información de la máquina seleccionada.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Formulario conectado a la ruta update con método PUT y seguridad activa -->
        <form action="{{ route('maquinaria.update', $maquinaria->id_maquinaria) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <!-- CORREGIDO: value dinámico con name="nombre_maquina" -->
                <input type="text" name="nombre_maquina" class="form-control" value="{{ $maquinaria->nombre_maquina }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Marca</label>
                <!-- CORREGIDO: value dinámico con name="marca" -->
                <input type="text" name="marca" class="form-control" value="{{ $maquinaria->marca }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <!-- CORREGIDO: value dinámico con name="modelo" -->
                <input type="text" name="modelo" class="form-control" value="{{ $maquinaria->modelo }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <!-- CORREGIDO: name="estatus" con marcador select inteligente -->
                <select name="estatus" class="form-control" required>
                    <option value="Operando" {{ $maquinaria->estatus == 'Operando' ? 'selected' : '' }}>Operando</option>
                    <option value="En reparación" {{ $maquinaria->estatus == 'En reparación' ? 'selected' : '' }}>En reparación</option>
                    <option value="Fuera de servicio" {{ $maquinaria->estatus == 'Fuera de servicio' ? 'selected' : '' }}>Fuera de servicio</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Adquisición</label>
                <!-- CORREGIDO: value dinámico con name="fecha_adquisicion" -->
                <input type="date" name="fecha_adquisicion" class="form-control" value="{{ $maquinaria->fecha_adquisicion }}">
            </div>

            <!-- CORREGIDO: Atributo type="submit" asignado -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i> Actualizar
            </button>

            <a href="/maquinaria" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i> Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
