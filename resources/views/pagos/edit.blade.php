@extends('layouts.app')

@section('contenido')

<h1>Editar Pago</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Cliente</label>
                <input type="text" class="form-control" value="Juan Pérez">
            </div>

            <div class="mb-3">
                <label>Pedido</label>
                <input type="text" class="form-control" value="Pedido #1">
            </div>

            <div class="mb-3">
                <label>Fecha de pago</label>
                <input type="date" class="form-control" value="2026-06-15">
            </div>

            <div class="mb-3">
                <label>Monto pagado</label>
                <input type="number" class="form-control" value="500">
            </div>

            <div class="mb-3">
                <label>Método de pago</label>

                <select class="form-control">
                    <option selected>Efectivo</option>
                    <option>Transferencia</option>
                    <option>Tarjeta</option>
                </select>

            </div>

            <button class="btn btn-success">
                Actualizar
            </button>

            <a href="/pagos" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection