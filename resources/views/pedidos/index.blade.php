@extends('layouts.app')

@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-bag-fill"></i>

        Gestión de Pedidos

    </h1>

    <p class="text-muted">

        Control y seguimiento de los pedidos registrados.

    </p>

</div>


<div class="d-flex justify-content-between align-items-center mb-3">

    <input
    type="text"
    class="form-control w-50"
    placeholder="Buscar pedidos...">

    <a href="/pedidos/create"
    class="btn btn-warning">

        <i class="bi bi-bag-fill"></i>
        Nuevo Pedido

    </a>

</div>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha Pedido</th>
            <th>Descripción</th>
            <th>Fecha Entrega</th>
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
            <td>
                100 playeras deportivas <br>
                50 pantalones escolares <br>
                20 chamarras <br>
                100 sudaderas <br>
                250 conjuntos 
            </td>
            <td>20/06/2026</td>
            <td>$1,500</td>

            <td>
                <span class="badge bg-success">
                    Completado
                </span>
            </td>

            <td>
                <a href="/pedidos/edit" class="btn btn-warning btn-sm">
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