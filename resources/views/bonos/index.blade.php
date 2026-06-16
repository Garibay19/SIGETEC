@extends('layouts.app')

@section('contenido')

<h1>Bonos</h1>

<a href="/bonos/create" class="btn btn-primary mb-3">
    Nuevo Bono
</a>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Trabajador</th>
            <th>Fecha</th>
            <th>Motivo</th>
            <th>Monto</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>María López</td>
            <td>15/06/2026</td>
            <td>Productividad</td>
            <td>$500</td>

            <td>
                <a href="/bonos/edit" class="btn btn-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>

    </tbody>

</table>

@endsection