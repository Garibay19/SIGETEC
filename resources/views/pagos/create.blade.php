@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-cash-stack" style="color:#d4af37;"></i>
        Nuevo Pago
    </h1>
    <p class="text-muted">
        Registra un nuevo pago de un pedido.
    </p>
</div>

<div class="card">
    <div class="card-body">

        <!-- CORREGIDO: Formulario conectado a la ruta de guardar pagos y autocompletado apagado -->
        <form action="{{ route('pagos.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label class="form-label">Seleccionar Pedido Relacionado</label>
                <!-- CORREGIDO: Lista desplegable que jala los folios reales con su saldo pendiente actual -->
                <select name="id_pedido" class="form-control" required>
                    <option value="">-- Seleccione el Pedido / Cliente --</option>
                    @foreach($pedidos as $pedido)
                        <option value="{{ $pedido->id_pedido }}">
                            Pedido #{{ $pedido->id_pedido }} - Cliente: {{ $pedido->cliente->nombre ?? 'Desconocido' }} (Debe: ${{ number_format($pedido->saldo_pendiente, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Pago</label>
                <!-- CORREGIDO: name="fecha_pago" e inyectamos la fecha actual por defecto -->
                <input type="date" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Abono (Cantidad a pagar hoy)</label>
                <!-- CORREGIDO: name="abono" asignado para operar la resta matemática -->
                <input type="number" name="abono" step="0.01" class="form-control" placeholder="Cantidad abonada" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Método de Pago</label>
                <!-- CORREGIDO: name="metodo_pago" asignado -->
                <select name="metodo_pago" class="form-control" required>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Tarjeta">Tarjeta</option>
                </select>
            </div>

            <!-- Nota: Los campos de "Monto Total", "Saldo Restante" y "Estado" se eliminan visualmente de la captura de datos ya que tu Controlador se encarga de calcularlos, actualizarlos e inyectarlos de forma matemática estricta y transparente en MySQL -->

            <!-- CORREGIDO: Atributo type="submit" para activar el proceso -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle-fill"></i>
                Guardar
            </button>

            <a href="/pagos" class="btn btn-secondary">
                <i class="bi bi-x-circle-fill"></i>
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection
