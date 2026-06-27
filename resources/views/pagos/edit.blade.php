@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Control de Abonos Acumulados
    </h1>
    <p class="text-muted">Historial de aportaciones y registro de nuevas fechas de pago.</p>
</div>

<!-- ALERTAS DE CONTROL -->
@if(session('error'))
    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
@endif

<div class="row">
    <!-- PANEL IZQUIERDO: DETALLES GENERALES Y HISTORIAL -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <div class="card-header bg-light border-0 pt-3 px-4">
                <h5 class="mb-0" style="font-weight: bold;"><i class="bi bi-clock-history text-muted"></i> Fechas de Pago Registradas</h5>
            </div>
            <div class="card-body px-4">
                <table class="table table-sm table-hover align-middle">
                    <thead>
                        <tr class="text-muted" style="font-size: 14px;">
                            <th>Fecha</th>
                            <th>Método</th>
                            <th class="text-end">Monto Abonado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalRecaudadoPedido = 0; @endphp
                        @foreach($historialPagos as $item)
                            @php $totalRecaudadoPedido += $item->abono; @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->fecha_pago)->format('d/m/Y') }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $item->metodo_pago }}</span></td>
                                <td class="text-end text-success font-weight-bold">+${{ number_format($item->abono, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="border-top mt-3 pt-3" style="font-size: 15px;">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Monto Total del Pedido:</span>
                        <strong>${{ number_format($pedido->total, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1 text-success">
                        <span>Suma de Abonos a la Fecha:</span>
                        <strong>+${{ number_format($totalRecaudadoPedido, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-2" style="font-size: 17px; font-weight: bold;">
                        <span>Saldo Pendiente Restante:</span>
                        @if($pedido->saldo_pendiente > 0)
                            <span class="text-danger">${{ number_format($pedido->saldo_pendiente, 2) }}</span>
                        @else
                            <span class="text-success"><i class="bi bi-check-all"></i> ¡Pago Cubierto por Completo!</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL DERECHO: FORMULARIO PARA AGREGAR NUEVA FECHA -->
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: 15px; {{ $pedido->saldo_pendiente <= 0 ? 'opacity: 0.7;' : '' }}">
            <div class="card-header bg-light border-0 pt-3 px-4">
                <h5 class="mb-0" style="font-weight: bold;"><i class="bi bi-plus-circle text-success"></i> Agregar Nueva Fecha / Abono</h5>
            </div>
            <div class="card-body p-4">
                @if($pedido->saldo_pendiente > 0)
                    <form action="{{ route('pagos.update', $pagoActual->id_pago) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-muted">Cliente</label>
                            <!-- CORREGIDO: Cambiado de nombre a nombre_completo para leer la base de datos relacional sin romperse -->
                            <input type="text" class="form-control bg-light" value="{{ $pedido->cliente->nombre_completo ?? 'Desconocido' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Pedido Afectado</label>
                            <input type="text" class="form-control bg-light" value="Orden de Confección #{{ $pedido->id_pedido }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Nueva Fecha de Pago</label>
                            <input type="date" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Monto del Nuevo Abono</label>
                            <input type="number" name="abono" step="0.01" max="{{ $pedido->saldo_pendiente }}" class="form-control" placeholder="Ejemplo: 500.00" required>
                            <small class="text-muted">No puede superar el saldo pendiente actual.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Método de Pago</label>
                            <select name="metodo_pago" class="form-control" required>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Tarjeta">Tarjeta</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-2">
                            <i class="bi bi-plus-circle-fill"></i> Acumular Pago y Actualizar
                        </button>
                    </form>
                @else
                    <div class="text-center py-5">
                        <div class="text-success mb-3" style="font-size: 50px;"><i class="bi bi-patch-check-fill"></i></div>
                        <h5 style="font-weight: bold;">Pedido Liquidado</h5>
                        <p class="text-muted small px-3">Este pedido ya no cuenta con deudas pendientes. No es posible inyectar más abonos.</p>
                    </div>
                @endif

                <div class="mt-3">
                    <a href="/pagos" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left-circle-fill"></i> Volver al Historial
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
