@extends('layouts.app')

@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-credit-card-fill"></i>

        Gestión de Pagos

    </h1>

    <p class="text-muted">

        Administra y consulta los pagos registrados.

    </p>

</div>

<div class="d-flex justify-content-between align-items-center mb-3">

    <input
    type="text"
    class="form-control w-50"
    placeholder="Buscar pagos...">

    <a href="/pagos/create"
    class="btn btn-warning">

        <i class="bi bi-cash-stack"></i>
        Nuevo Pago

    </a>

</div>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Pedido</th>
            <th>Fecha de Pago</th>
            <th>Monto Total</th>
            <th>Abono</th>
            <th>Método</th>
            <th>Saldo Restante</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Juan Pérez</td>
            <td>Pedido #1</td>
            <td>15/06/2026</td>
            <td>25,000</td>
            <td>$500</td>
            <td>Efectivo</td>
            <td>$1,000</td>
            <td>
                <span class="badge bg-warning text-dark">
    Parcial
</span>
            </td>
            
            <td>
                <a href="/pagos/edit" class="btn btn-warning btn-sm">
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