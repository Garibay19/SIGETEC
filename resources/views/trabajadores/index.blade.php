@extends('layouts.app')

@section('contenido')

<h1>Trabajadores</h1>

<a href="/trabajadores/create" class="btn btn-primary mb-3">
    Nuevo Trabajador
</a>

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
            <td>Activo</td>
            <td>
                <a href="/trabajadores/edit" class="btn btn-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>
    </tbody>
</table>

@endsection