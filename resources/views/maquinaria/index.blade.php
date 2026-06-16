@extends('layouts.app')

@section('contenido')

<h1>Maquinaria</h1>

<a href="/maquinaria/create" class="btn btn-primary mb-3">
    Nueva Máquina
</a>

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
                    Editar
                </a>
            </td>
        </tr>

    </tbody>

</table>

@endsection