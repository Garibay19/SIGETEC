@extends('layouts.app')

@section('contenido')

<h1>Pedidos</h1>

<a href="/pedidos/create" class="btn btn-primary mb-3">
    Nuevo Pedido
</a>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>Juan Pérez</td>
            <td>15/06/2026</td>
            <td>$1,500</td>
            <td>Pendiente</td>

            <td>
                <a href="/pedidos/edit" class="btn btn-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>

    </tbody>

</table>

@endsection