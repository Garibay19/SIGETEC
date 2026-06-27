@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-box-seam-fill" style="color:#d4af37;"></i>
        Nuevo Material
    </h1>
    <p class="text-muted">
        Registra un nuevo material en el inventario.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Formulario enlazado a la ruta store con método POST y seguridad activa -->
        <form action="{{ route('materiales.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del Material</label>
                <!-- CORREGIDO: name="nombre_material" añadido -->
                <input type="text" name="nombre_material" class="form-control" placeholder="Ejemplo: Tela mezclilla" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <!-- CORREGIDO: name="categoria" añadido -->
                <input type="text" name="categoria" class="form-control" placeholder="Tela, hilo, botón, cierre" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock (Cantidad Disponible Sana)</label>
                <!-- CORREGIDO: name="stock" añadido -->
                <input type="number" name="stock" class="form-control" placeholder="Cantidad disponible" required>
            </div>

            <!-- NUEVO: Campo solicitado para el registro de Material Dañado -->
            <div class="mb-3">
                <label class="form-label">Stock Dañado / Merma</label>
                <input type="number" name="stock_danado" class="form-control" placeholder="Cantidad de material dañado o desperdicio" value="0" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Unidad de Medida</label>
                <!-- CORREGIDO: name="unidad_medida" añadido -->
                <input type="text" name="unidad_medida" class="form-control" placeholder="Metros, piezas, rollos" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Costo Unitario</label>
                <!-- CORREGIDO: name="costo_unitario" con soporte de decimales -->
                <input type="number" name="costo_unitario" step="0.01" class="form-control" placeholder="Costo por unidad" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Proveedor</label>
                <!-- CORREGIDO: name="proveedor" añadido -->
                <input type="text" name="proveedor" class="form-control" placeholder="Nombre del proveedor">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Compra</label>
                <!-- CORREGIDO: name="fecha_compra" añadido -->
                <input type="date" name="fecha_compra" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <!-- CORREGIDO: type="submit" para activar el proceso -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i> Guardar
            </button>

            <a href="/materiales" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i> Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
