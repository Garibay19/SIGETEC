@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-cash-coin" style="color:#d4af37;"></i>
        Registrar Nuevo Abono / Pago
    </h1>
    <p class="text-muted">Selecciona el pedido de un cliente para abonar a su deuda activa en tiempo real.</p>
</div>

<!-- Contenedor del Formulario con Diseño Premium -->
<div class="card shadow border-0 mx-auto" style="border-radius: 20px; max-width: 750px; background: #ffffff;">
    <div class="card-body p-5">
        <form action="{{ route('pagos.store') }}" method="POST">
            @csrf

            <!-- Menú Desplegable de Selección -->
            <div class="mb-4">
                <label for="id_pedido" class="form-label fw-bold text-dark"><i class="bi bi-search" style="color: #c89b3c;"></i> Seleccionar Pedido y Cliente</label>
                <select name="id_pedido" id="id_pedido" class="form-select form-select-lg" onchange="actualizarDatosPedido()" style="border-radius: 10px; border: 2px solid #e0e0e0; font-size: 16px;" required>
                    <option value="" disabled selected>-- Seleccione el pedido de un cliente --</option>
                    @foreach($pedidos as $pedido)
                        <!-- Inyectamos también la descripción del pedido dentro de un atributo data- para que lo lea JavaScript -->
                        <option value="{{ $pedido->id_pedido }}" 
                                data-cliente="{{ $pedido->cliente->nombre_completo ?? 'Cliente no encontrado' }}"
                                data-total="{{ $pedido->total }}"
                                data-saldo="{{ $pedido->saldo_pendiente }}"
                                data-descripcion="{{ $pedido->descripcion ?? 'Sin descripción disponible' }}">
                            Pedido #{{ $pedido->id_pedido }} - {{ $pedido->cliente->nombre_completo ?? 'Desconocido' }} (Saldo: ${{ number_format($pedido->saldo_pendiente, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- TARJETA DE RESUMEN PREMIUM CON DESCRIPCIÓN INCLUIDA -->
            <div id="tarjetaInformacion" class="card mb-4 border-0 shadow-sm" style="border-radius: 15px; display: none; background: #fbfbfb; border-left: 5px solid #c89b3c !important;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 11px; color: #c89b3c;">
                        <i class="bi bi-file-earmark-text-fill"></i> Detalle del Pedido Seleccionado
                    </h6>
                    
                    <div class="row text-center mb-3">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block uppercase font-weight-bold" style="font-size: 12px;">Cliente Asociado</small>
                            <span id="infoCliente" class="fw-bold text-dark fs-5">-</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block uppercase font-weight-bold" style="font-size: 12px;">Saldo Pendiente Actual</small>
                            <span id="infoSaldo" class="fw-bold text-danger fs-4">$0.00</span>
                        </div>
                    </div>

                    <!-- NUEVO: Contenedor Dinámico para la Descripción del Pedido Textil -->
                    <div class="bg-white p-3 rounded border" style="border-radius: 10px;">
                        <small class="text-muted d-block fw-bold mb-1" style="font-size: 12px;"><i class="bi bi-info-circle"></i> Trabajo Solicitado / Notas de Confección:</small>
                        <p id="infoDescripcion" class="text-secondary mb-0 italic" style="font-size: 14px; font-style: italic; line-height: 1.5;">-</p>
                    </div>
                </div>
            </div>

            <!-- Inputs Financieros -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="abono" class="form-label fw-bold text-dark"><i class="bi bi-currency-dollar" style="color: #c89b3c;"></i> Monto del Abono ($)</label>
                    <input type="number" name="abono" id="abono" class="form-control form-control-lg" step="0.01" min="0.01" placeholder="0.00" oninput="validarMontoAbono()" style="border-radius: 10px;" required disabled>
                    <div id="alertaMonto" class="form-text text-danger fw-bold mt-2" style="display: none; font-size: 13px;">
                        <i class="bi bi-exclamation-triangle-fill"></i> ¡El abono no puede superar el saldo pendiente!
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="metodo_pago" class="form-label fw-bold text-dark"><i class="bi bi-wallet2" style="color: #c89b3c;"></i> Método de Pago</label>
                    <select name="metodo_pago" id="metodo_pago" class="form-select form-select-lg" style="border-radius: 10px;" required disabled>
                        <option value="Efectivo" selected>Efectivo</option>
                        <option value="Transferencia">Transferencia Bancaria</option>
                        <option value="Tarjeta">Tarjeta de Crédito/Débito</option>
                    </select>
                </div>
            </div>

            <!-- Botones de Acción Estilizados -->
            <div class="d-flex gap-3 justify-content-end mt-2">
                <a href="/pagos" class="btn btn-light border px-4 py-2 fw-semibold" style="border-radius: 10px; font-size: 15px;">Cancelar</a>
                <button type="submit" id="btnGuardar" class="btn btn-warning px-5 py-2" style="border-radius: 10px; font-weight: bold; color: #0b0b0b; background: #d4af37; border-color: #d4af37; font-size: 15px;" disabled>
                    <i class="bi bi-check-circle-fill"></i> Registrar Abono
                </button>
            </div>
        </form>
    </div>
</div>

<!-- LÓGICA JAVASCRIPT MEJORADA PARA INYECTAR LA DESCRIPCIÓN -->
<script>
    let saldoPendienteActual = 0;

    function actualizarDatosPedido() {
        const select = document.getElementById('id_pedido');
        const opcionSeleccionada = select.options[select.selectedIndex];
        
        if (opcionSeleccionada.value !== "") {
            const nombreCliente = opcionSeleccionada.getAttribute('data-cliente');
            const descripcionPedido = opcionSeleccionada.getAttribute('data-descripcion');
            saldoPendienteActual = parseFloat(opcionSeleccionada.getAttribute('data-saldo'));

            // Inyectamos los datos en tiempo real (Incluyendo la nueva descripción)
            document.getElementById('infoCliente').innerText = nombreCliente;
            document.getElementById('infoSaldo').innerText = '$' + saldoPendienteActual.toLocaleString('es-MX', { minimumFractionDigits: 2 });
            document.getElementById('infoDescripcion').innerText = descripcionPedido;
            
            // Activamos la tarjeta con animación flex/block e inputs
            document.getElementById('tarjetaInformacion').style.display = 'block';
            document.getElementById('abono').disabled = false;
            document.getElementById('metodo_pago').disabled = false;
            
            // Reiniciamos valores del input de abono
            document.getElementById('abono').value = '';
            document.getElementById('abono').max = saldoPendienteActual;
            document.getElementById('alertaMonto').style.display = 'none';
            document.getElementById('btnGuardar').disabled = false;
            document.getElementById('abono').classList.remove('is-invalid');
        }
    }

    function validarMontoAbono() {
        const inputAbono = document.getElementById('abono');
        const btnGuardar = document.getElementById('btnGuardar');
        const alerta = document.getElementById('alertaMonto');
        const montoIngresado = parseFloat(inputAbono.value) || 0;

        if (montoIngresado > saldoPendienteActual) {
            alerta.style.display = 'block';
            btnGuardar.disabled = true;
            inputAbono.classList.add('is-invalid');
        } else if (montoIngresado <= 0) {
            btnGuardar.disabled = true;
            alerta.style.display = 'none';
        } else {
            alerta.style.display = 'none';
            btnGuardar.disabled = false;
            inputAbono.classList.remove('is-invalid');
        }
    }
</script>

@endsection
