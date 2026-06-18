@extends('layouts.app')

@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-person-workspace"></i>


        Gestión de Trabajadores

    </h1>

    <p class="text-muted">

        Administra la información del personal autorizado.

    </p>

</div>

<div class="d-flex justify-content-between align-items-center mb-3">

    <input
    type="text"
    class="form-control w-50"
    placeholder="Buscar Trabajadores...">

    <a href="/trabajadores/create"
    class="btn btn-warning">

        <i class="bi bi-person-workspace"></i>
        Nuevo Trabajador

    </a>

</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Teléfono</th>
            <th>Puesto</th>
            <th>Área asignada</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>María López</td>
            <td>2411234567</td>
            <td>Costurera</td>
            <td>Confección</td>
            <td>

    <span class="badge bg-success">
        Activo
    </span>

</td>
            
            <td>
                <a href="/trabajadores/edit" class="btn btn-warning btn-sm">
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