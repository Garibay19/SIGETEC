@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Pago

</h1>

<p class="text-muted">

    Modifica la información del pago seleccionado.

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
                Pedido
            </label>

            <input
            type="text"
            class="form-control"
            value="Pedido #1">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha de Pago
            </label>

            <input
            type="date"
            class="form-control"
            value="2026-06-15">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Monto Total
            </label>

            <input
            type="number"
            class="form-control"
            value="25000">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Abono
            </label>

            <input
            type="number"
            class="form-control"
            value="500">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Saldo Restante
            </label>

            <input
            type="number"
            class="form-control"
            value="1000">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Método de Pago
            </label>

            <select class="form-control">

                <option selected>Efectivo</option>
                <option>Transferencia</option>
                <option>Tarjeta</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Estado
            </label>

            <select class="form-control">

                <option>Pendiente</option>
                <option selected>Parcial</option>
                <option>Pagado</option>

            </select>

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Actualizar

        </button>

        <a href="/pagos"
        class="btn btn-secondary">

            <i class="bi bi-x-circle-fill"></i>
            Cancelar

        </a>

    </form>

</div>

</div>

@endsection
