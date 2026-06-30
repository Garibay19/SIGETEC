@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 style="font-weight:bold;">
                <i class="bi bi-bag-fill" style="color:#d4af37;"></i>
                Listado de Pedidos
            </h1>
            <p class="text-muted">Gestión de órdenes de confección y estados de producción.</p>
        </div>
        <!-- CORREGIDO: Ocultar botón de Nuevo Pedido al rol Invitado -->
        @if(auth()->user()?->role !== 'Invitado')
            <a href="/pedidos/create" class="btn btn-primary" style="background-color: #d4af37; border-color: #d4af37;">
                <i class="bi bi-plus-circle-fill"></i> Nuevo Pedido
            </a>
        @endif
    </div>
</div>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th class="text-start">Cliente</th>
                        <th>Descripción</th>
                        <th>Fecha de Entrega</th>
                        <th>Total</th>
                        <th>Saldo Pendiente</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo dinámico de Laravel para recorrer los pedidos reales de la base de datos -->
                    @forelse($pedidos as $pedido)
                        <tr>
                            <td><strong>#{{ $pedido->id_pedido }}</strong></td>
                            <!-- Accedemos al nombre del cliente asignado relacionalmente -->
                            <td class="text-start">{{ $pedido->cliente->nombre_completo ?? 'Cliente no encontrado' }}</td>
                            <td>{{ $pedido->descripcion }}</td>
                            <td>{{ \Carbon\Carbon::parse($pedido->fecha_entrega)->format('d/m/Y') }}</td>
                            <td>${{ number_format($pedido->total, 2) }}</td>
                            <td>
                                @if($pedido->saldo_pendiente > 0)
                                    <span class="text-danger fw-bold">${{ number_format($pedido->saldo_pendiente, 2) }}</span>
                                @else
                                    <span class="text-success fw-bold">Pagado</span>
                                @endif
                            </td>
                            <td>
                                @if($pedido->estado == 'Pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($pedido->estado == 'En proceso')
                                    <span class="badge bg-info text-dark">En proceso</span>
                                @elseif($pedido->estado == 'Terminado')
                                    <span class="badge bg-success">Terminado</span>
                                @else
                                    <span class="badge bg-secondary">{{ $pedido->estado }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- CORREGIDO: Bloqueo de acciones para usuarios Invitados -->
                                    @if(auth()->user()?->role !== 'Invitado')
                                        <!-- CORREGIDO: Ajustado el parámetro a 'id' de acuerdo a tu routes/web.php -->
                                        <a href="{{ route('pedidos.edit', ['id' => $pedido->id_pedido]) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                        
                                        <!-- CORREGIDO: Ajustado el parámetro a 'id' en el formulario seguro de eliminación -->
                                        <form action="{{ route('pedidos.destroy', ['id' => $pedido->id_pedido]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este pedido? Esta acción no se puede deshacer.');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash-fill"></i> Borrar
                                            </button>
                                        </form>
                                    @else
                                        <!-- CORREGIDO: Ajustada la insignia con el estilo exacto y unificado de 14px -->
                                        <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 14px;">
                                            <i class="bi bi-eye-fill"></i> Solo Lectura
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle fs-4"></i> No hay pedidos registrados en este momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
