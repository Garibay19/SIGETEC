@extends('layouts.app')

@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-bag-fill"
        style="color:#d4af37;"></i>

        Nuevo Pedido

    </h1>

    <p class="text-muted">

        Registra un nuevo pedido en el sistema.

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
                    Descripción del Pedido
                </label>

                <textarea
                class="form-control"
                rows="4"
                placeholder="Ejemplo: 100 playeras deportivas, 50 pantalones escolares, 20 chamarras">
                </textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Fecha del Pedido
                </label>

                <input
                type="date"
                class="form-control">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Fecha de Entrega
                </label>

                <input
                type="date"
                class="form-control">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Total
                </label>

                <input
                type="number"
                class="form-control"
                placeholder="Monto total">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Estado
                </label>

                <select class="form-control">

                    <option>Pendiente</option>
                    <option>En proceso</option>
                    <option>Terminado</option>
                    <option>Entregado</option>

                </select>

            </div>

            <button class="btn btn-success">

                <i class="bi bi-check-circle-fill"></i>
                Guardar

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