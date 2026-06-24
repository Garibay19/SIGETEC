@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-bag-fill" style="color:#d4af37;"></i>
        Nuevo Pedido
    </h1>
    <p class="text-muted">Registra un nuevo pedido en el sistema.</p>
</div>

<div class="card">
    <div class="card-body">

        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

           <div class="mb-3">
                <label class="form-label">Cliente</label>
                <!-- MODIFICADO: Ahora es una caja de texto libre para escribir el nombre de cualquier cliente -->
                <input type="text" name="nombre_cliente" class="form-control" placeholder="Escriba el nombre completo del cliente" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha del Pedido</label>
                <input type="date" name="fecha_pedido" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del Pedido</label>
                <textarea name="descripcion" class="form-control" rows="4" placeholder="Ejemplo: 100 playeras deportivas, 50 pantalones escolares, 20 chamarras" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Entrega</label>
                <input type="date" name="fecha_entrega" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total</label>
                <input type="number" name="total" step="0.01" class="form-control" placeholder="Monto total" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <!-- CONECTADO: name="estado" agregado para que viaje al controlador -->
                <select name="estado" class="form-control" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Terminado">Terminado</option>
                    <option value="Entregado">Entregado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i> Guardar
            </button>

            <a href="/pedidos" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i> Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
