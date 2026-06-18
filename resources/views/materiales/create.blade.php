@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-box-seam-fill"
    style="color:#d4af37;"></i>

    Nuevo Material

</h1>

<p class="text-muted">

    Registra un nuevo material en el inventario.

</p>

</div>

<div class="card">

<div class="card-body">

    <form>

        <div class="mb-3">

            <label class="form-label">
                Nombre del Material
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Ejemplo: Tela mezclilla">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Categoría
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Tela, hilo, botón, cierre">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Stock
            </label>

            <input
            type="number"
            class="form-control"
            placeholder="Cantidad disponible">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Unidad de Medida
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Metros, piezas, rollos">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Costo Unitario
            </label>

            <input
            type="number"
            class="form-control"
            placeholder="Costo por unidad">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Proveedor
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Nombre del proveedor">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha de Compra
            </label>

            <input
            type="date"
            class="form-control">

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Guardar

        </button>

        <a href="/materiales"
        class="btn btn-secondary">

            <i class="bi bi-x-circle-fill"></i>
            Cancelar

        </a>

    </form>

</div>

</div>

@endsection
