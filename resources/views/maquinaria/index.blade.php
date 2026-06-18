@extends('layouts.app')

@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-gear-fill"></i>

        Gestión de Maquinaria

    </h1>

    <p class="text-muted">

        Administra la maquinaria y equipos registrados.

    </p>

</div>

<div class="d-flex justify-content-between align-items-center mb-3">

    <input
    type="text"
    class="form-control w-50"
    placeholder="Buscar maquinaria...">

    <a href="/maquinaria/create"
    class="btn btn-warning">

        <i class="bi bi-gear-fill"></i>
        Nueva Maquina 

    </a>

</div>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Estado</th>
            <th>Fecha de adquisición</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>Máquina Recta</td>
            <td>Juki</td>
            <td>DDL-8700</td>
            <td>Operando</td>
            <td>10/03/2025</td>

            <td>
                <a href="/maquinaria/edit" class="btn btn-warning btn-sm">
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