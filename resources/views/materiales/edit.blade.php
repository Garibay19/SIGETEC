@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Editar Material
    </h1>
    <p class="text-muted">
        Modifica la información del material seleccionado.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Formulario enlazado a la ruta update con método PUT, token de seguridad y autocompletado apagado -->
        <form action="{{ route('materiales.update', $material->id_material) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre del Material</label>
                <!-- CORREGIDO: value dinámico con name="nombre_material" y obligatorio -->
                <input type="text" name="nombre_material" class="form-control" value="{{ $material->nombre_material }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <!-- CORREGIDO: value dinámico con name="categoria" y obligatorio -->
                <input type="text" name="categoria" class="form-control" value="{{ $material->categoria }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock (Cantidad Disponible Sana)</label>
                <!-- CORREGIDO: value dinámico con name="stock" y obligatorio -->
                <input type="number" name="stock" class="form-control" value="{{ $material->stock }}" required>
            </div>

            <!-- NUEVO: Campo para el control y modificación del Material Dañado -->
            <div class="mb-3">
                <label class="form-label">Stock Dañado / Merma</label>
                <input type="number" name="stock_danado" class="form-control" value="{{ $material->stock_danado }}" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Unidad de Medida</label>
                <!-- CORREGIDO: value dinámico con name="unidad_medida" y obligatorio -->
                <input type="text" name="unidad_medida" class="form-control" value="{{ $material->unidad_medida }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Costo Unitario</label>
                <!-- CORREGIDO: value dinámico con name="costo_unitario" con soporte de decimales -->
                <input type="number" name="costo_unitario" step="0.01" class="form-control" value="{{ $material->costo_unitario }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Proveedor</label>
                <!-- CORREGIDO: value dinámico con name="proveedor" -->
                <input type="text" name="proveedor" class="form-control" value="{{ $material->proveedor }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Compra</label>
                <!-- CORREGIDO: value dinámico con name="fecha_compra" -->
                <input type="date" name="fecha_compra" class="form-control" value="{{ $material->fecha_compra }}">
            </div>

            <!-- CORREGIDO: Atributo type="submit" para activar la actualización en el controlador -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i> Actualizar
            </button>

            <a href="/materiales" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i> Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
