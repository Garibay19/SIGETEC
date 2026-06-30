@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 style="font-weight:bold;">
                <i class="bi bi-cash-stack" style="color:#d4af37;"></i>
                Historial de Pagos
            </h1>
            <p class="text-muted">Monitoreo de transacciones, abonos y flujos de caja.</p>
        </div>
        <!-- CORREGIDO: Ocultar botón Registrar Pago para cuentas con nivel de Invitado -->
        @if(auth()->user()?->role !== 'Invitado')
            <a href="/pagos/create" class="btn btn-primary" style="background-color: #d4af37; border-color: #d4af37;">
                <i class="bi bi-plus-circle-fill"></i> Registrar Pago
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
                        <th>ID Pago</th>
                        <th class="text-start">Pedido Afectado (Cliente)</th>
                        <th>Fecha de Pago</th>
                        <th>Total Pedido</th>
                        <th>Monto Abonado</th>
                        <th>Saldo Restante</th>
                        <th>Método</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Variable para acumular la suma de los abonos en pantalla -->
                    @php $sumaTotalAbonos = 0; @endphp

                    @forelse($pagos as $pago)
                        @php $sumaTotalAbonos += $pago->abono; @endphp
                        <tr>
                            <td><strong>#{{ $pago->id_pago }}</strong></td>
                            <!-- CORREGIDO: Ahora muestra el nombre del cliente real conectado al pedido -->
                            <td class="text-start">{{ $pago->pedido->cliente->nombre_completo ?? 'Pedido #' . $pago->id_pedido }}</td>

                            <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td>${{ number_format($pago->monto_total_pedido, 2) }}</td>
                            <td class="text-success fw-bold">+${{ number_format($pago->abono, 2) }}</td>
                            <td>
                                @if($pago->saldo_restante > 0)
                                    <span class="text-danger fw-bold">${{ number_format($pago->saldo_restante, 2) }}</span>
                                @else
                                    <span class="text-success fw-bold">Liquidado</span>
                                @endif
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $pago->metodo_pago }}</span></td>
                            <td><span class="badge bg-success">{{ $pago->estado }}</span></td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- CORREGIDO: Bloqueo de acciones de abonos acumulados para rol Invitado -->
                                    @if(auth()->user()?->role !== 'Invitado')
                                        <a href="{{ route('pagos.edit', $pago->id_pago) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                    @else
                                        <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 11px;">
                                            <i class="bi bi-eye-fill"></i> Solo Lectura
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle fs-4"></i> No se han registrado abonos en este módulo.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                
                <!-- CORREGIDO: Fila de suma total con tfoot cerrado correctamente sin errores de renderizado HTML -->
                @if($pagos->count() > 0)
                    <tfoot class="table-light" style="border-top: 2px solid #dee2e6;">
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total Recaudado en Pantalla:</strong></td>
                            <td class="text-success" style="font-size: 18px; font-weight: bold;">
                                ${{ number_format($sumaTotalAbonos, 2) }}
                            </td>
                            <td colspan="5"></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

@endsection
