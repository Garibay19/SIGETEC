@extends('layouts.app')

@section('contenido')

<h1>Reportes</h1>

<a href="/reportes/create" class="btn btn-primary mb-3">
    Nuevo Reporte
</a>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo de reporte</th>
            <th>Fecha</th>
            <th>Generado por</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>Reporte de ventas</td>
            <td>15/06/2026</td>
            <td>Administrador</td>

            <td>
                <a href="/reportes/edit" class="btn btn-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>

    </tbody>

</table>

@endsection