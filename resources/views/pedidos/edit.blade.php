@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Pedido

</h1>

<p class="text-muted">

    Modifica la información del pedido seleccionado.

</p>

</div>

<div class="card">

<div class="card-body">

    <form>

        <div class="mb-3">

            <label class="form-label">
                Cliente
            </label>

            <input
            type="text"
            class="form-control"
            value="Juan Pérez">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Descripción del Pedido
            </label>

            <textarea
            class="form-control"
            rows="4">100 playeras deportivas, 50 pantalones escolares</textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha del Pedido
            </label>

            <input
            type="date"
            class="form-control"
            value="2026-06-15">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha de Entrega
            </label>

            <input
            type="date"
            class="form-control"
            value="2026-06-20">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Total
            </label>

            <input
            type="number"
            class="form-control"
            value="1500">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Estado
            </label>

            <select class="form-control">

                <option>Pendiente</option>
                <option selected>En proceso</option>
                <option>Terminado</option>
                <option>Entregado</option>

            </select>

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Actualizar

        </button>

        <a href="/pedidos"
        class="btn btn-secondary">

            <i class="bi bi-x-circle-fill"></i>
            Cancelar

        </a>

    </form>

</div>


</div>

@endsection
