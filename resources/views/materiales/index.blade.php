@extends('layouts.app')

@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-box-seam-fill"></i>

        Gestión de Materiales

    </h1>

    <p class="text-muted">

        Control y administración de los materiales disponibles.

    </p>

</div>

<div class="d-flex justify-content-between align-items-center mb-3">

    <input
    type="text"
    class="form-control w-50"
    placeholder="Buscar materiales...">

    <a href="/materiales/create"
    class="btn btn-warning">

        <i class="bi bi-box-seam-fill"></i>
        Nuevo Material

    </a>

</div>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Material</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Unidad</th>
            <th>Costo Unitario</th>
            <th>Proveedor</th>
            <th>Fecha Compra</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>Tela Mezclilla</td>
            <td>Tela</td>
            <td>50</td>
            <td>Metros</td>
            <td>$120</td>
            <td>Textiles Puebla</td>
            <td>15/06/2026</td>

            <td>
                <a href="/materiales/edit" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                    Editar
                </a>

                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?')">
                    <i class="bi bi-trash-fill"></i>
                    Eliminar
                </button>
            </td>  
        </tr>

    </tbody>

</table>

@endsection