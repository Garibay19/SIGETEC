@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-gear-fill" style="color:#d4af37;"></i>
        Nueva Máquina
    </h1>
    <p class="text-muted">
        Registra una nueva máquina o equipo en el sistema.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- Formulario enlazado a la ruta store con método POST y seguridad activa -->
        <form action="{{ route('maquinaria.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <!-- name="nombre_maquina" obligatorio -->
                <input type="text" name="nombre_maquina" class="form-control" placeholder="Ejemplo: Máquina Recta" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Marca</label>
                <!-- name="marca" obligatorio -->
                <input type="text" name="marca" class="form-control" placeholder="Ejemplo: Juki" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <!-- name="modelo" obligatorio -->
                <input type="text" name="modelo" class="form-control" placeholder="Ejemplo: DDL-8700" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <!-- name="estatus" con el select del taller -->
                <select name="estatus" class="form-control" required>
                    <option value="Operando">Operando</option>
                    <option value="En reparación">En reparación</option>
                    <option value="Fuera de servicio">Fuera de servicio</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Adquisición</label>
                <!-- name="fecha_adquisicion" añadido -->
                <input type="date" name="fecha_adquisicion" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i> Guardar
            </button>

            <a href="/maquinaria" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i> Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
