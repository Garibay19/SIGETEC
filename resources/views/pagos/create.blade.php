@extends('layouts.app')

@section('contenido')

<h1>Nuevo Pago</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Cliente</label>
                <input type="text" class="form-control" placeholder="Nombre del cliente">
            </div>

            <div class="mb-3">
                <label>Pedido</label>
                <input type="text" class="form-control" placeholder="Pedido relacionado">
            </div>

            <div class="mb-3">
                <label>Fecha de pago</label>
                <input type="date" class="form-control">
            </div>

            <div class="mb-3">
                <label>Monto pagado</label>
                <input type="number" class="form-control" placeholder="Monto">
            </div>

            <div class="mb-3">
                <label>Método de pago</label>
                <select class="form-control">
                    <option>Efectivo</option>
                    <option>Transferencia</option>
                    <option>Tarjeta</option>
                </select>
            </div>

            <button class="btn btn-success">Guardar</button>
            <a href="/pagos" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

@endsection