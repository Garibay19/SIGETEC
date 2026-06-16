@extends('layouts.app')

@section('contenido')

<h1>Editar Pedido</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Cliente</label>
                <input type="text" class="form-control" value="Juan Pérez">
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" class="form-control" value="2026-06-15">
            </div>

            <div class="mb-3">
                <label>Total</label>
                <input type="number" class="form-control" value="1500">
            </div>

            <div class="mb-3">
                <label>Estado</label>

                <select class="form-control">
                    <option selected>Pendiente</option>
                    <option>En proceso</option>
                    <option>Terminado</option>
                    <option>Entregado</option>
                </select>

            </div>

            <button class="btn btn-success">
                Actualizar
            </button>

            <a href="/pedidos" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection