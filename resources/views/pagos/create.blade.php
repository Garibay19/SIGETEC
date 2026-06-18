@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-cash-stack"
    style="color:#d4af37;"></i>

    Nuevo Pago

</h1>

<p class="text-muted">

    Registra un nuevo pago de un pedido.

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
            placeholder="Nombre del cliente">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Pedido
            </label>

            <input
            type="text"
            class="form-control"
            placeholder="Pedido relacionado">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Fecha de Pago
            </label>

            <input
            type="date"
            class="form-control">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Monto Total
            </label>

            <input
            type="number"
            class="form-control"
            placeholder="Monto total del pedido">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Abono
            </label>

            <input
            type="number"
            class="form-control"
            placeholder="Cantidad abonada">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Saldo Restante
            </label>

            <input
            type="number"
            class="form-control"
            placeholder="Saldo pendiente">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Método de Pago
            </label>

            <select class="form-control">

                <option>Efectivo</option>
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
                <option>Parcial</option>
                <option>Pagado</option>

            </select>

        </div>

        <button class="btn btn-success">

            <i class="bi bi-check-circle-fill"></i>
            Guardar

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
