@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Material

</h1>

<p class="text-muted">

    Modifica la información del material seleccionado.

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
            value="Tela Mezclilla">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Categoría
            </label>

            <input
            type="text"
            class="form-control"
            value="Tela">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Stock
            </label>

            <input
            type="number"
            class="form-control"
            value="50">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Unidad de Medida
            </label>

            <input
            type="text"
            class="form-control"
            value="Metros">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Costo Unitario
            </label>

            <input
            type="number"
            class="form-control"
            value="120">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Proveedor
            </label>

            <input
            type="text"
            class="form-control"
            value="Textiles Puebla">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha de Compra
            </label>

            <input
            type="date"
            class="form-control"
            value="2026-06-15">

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Actualizar

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
