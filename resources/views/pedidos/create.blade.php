@extends('layouts.app')

@section('contenido')

<h1>Nuevo Pedido</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Cliente</label>
                <input type="text" class="form-control" placeholder="Nombre del cliente">
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" class="form-control">
            </div>

            <div class="mb-3">
                <label>Total</label>
                <input type="number" class="form-control" placeholder="Monto total">
            </div>

            <div class="mb-3">
                <label>Estado</label>

                <select class="form-control">
                    <option>Pendiente</option>
                    <option>En proceso</option>
                    <option>Terminado</option>
                    <option>Entregado</option>
                </select>

            </div>

            <button class="btn btn-success">
                Guardar
            </button>

            <a href="/pedidos" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection