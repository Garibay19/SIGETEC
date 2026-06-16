@extends('layouts.app')

@section('contenido')

<h1>Pagos</h1>

<a href="/pagos/create" class="btn btn-primary mb-3">
    Nuevo Pago
</a>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Pedido</th>
            <th>Fecha de Pago</th>
            <th>Monto</th>
            <th>Método</th>
            <th>Saldo Restante</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Juan Pérez</td>
            <td>Pedido #1</td>
            <td>15/06/2026</td>
            <td>$500</td>
            <td>Efectivo</td>
            <td>$1,000</td>
            <td>
                <a href="/pagos/edit" class="btn btn-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>
    </tbody>

</table>

@endsection