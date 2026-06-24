@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Editar Pedido
    </h1>
    <p class="text-muted">
        Modifica la información del pedido seleccionado.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Formulario enlazado a la ruta update con método PUT y autocompletado desactivado -->
        <form action="{{ route('pedidos.update', $pedido->id_pedido) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Cliente</label>
                <!-- Mostrar el nombre del cliente (No se edita aquí para mantener la integridad) -->
                <input type="text" class="form-control" value="{{ $pedido->cliente->nombre ?? 'Sin cliente' }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha del Pedido</label>
                <!-- CORREGIDO: Carga la fecha real del pedido -->
                <input type="date" name="fecha_pedido" class="form-control" value="{{ $pedido->fecha_pedido }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del Pedido</label>
                <!-- CORREGIDO: Carga la descripción real -->
                <textarea name="descripcion" class="form-control" rows="4" required>{{ $pedido->descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Entrega</label>
                <!-- CORREGIDO: Carga la fecha de entrega real -->
                <input type="date" name="fecha_entrega" class="form-control" value="{{ $pedido->fecha_entrega }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total</label>
                <!-- CORREGIDO: Carga el monto total real -->
                <input type="number" name="total" step="0.01" class="form-control" value="{{ $pedido->total }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <!-- CORREGIDO: Menú selector inteligente que marca el estado actual del pedido -->
                <select name="estado" class="form-control" required>
                    <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="En proceso" {{ $pedido->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                    <option value="Terminado" {{ $pedido->estado == 'Terminado' ? 'selected' : '' }}>Terminado</option>
                    <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                </select>
            </div>

            <!-- CORREGIDO: Botón con tipo submit asignado -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i>
                Actualizar
            </button>

            <a href="/pedidos" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i>
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
