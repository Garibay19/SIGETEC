@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-plus-circle-fill" style="color:#d4af37;"></i>
        Registrar Nuevo Pedido
    </h1>
    <p class="text-muted">Asigna una nueva orden de confección a un cliente registrado e indica los montos económicos.</p>
</div>

<div class="card shadow-sm border-0 mx-auto" style="border-radius: 15px; max-width: 700px;">
    <div class="card-body p-4">
        <!-- Formulario apunta al controlador de guardado de Pedidos -->
        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

            <!-- MENÚ DESPLEGABLE CONECTADO AL MÓDULO DE CLIENTES -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label fw-bold">Seleccionar Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-select" required>
                    <option value="" disabled selected>-- Seleccione un cliente del catálogo --</option>
                    @foreach($clientes as $cliente)
                        <!-- Guardamos el ID del cliente pero le mostramos su Nombre Completo -->
                        <option value="{{ $cliente->id_cliente }}">
                            {{ $cliente->nombre_completo }} (ID: {{ $cliente->id_cliente }})
                        </option>
                    @endforeach
                </select>
                <div class="form-text text-muted">Si el cliente no aparece, debes registrarlo primero en el módulo de Clientes.</div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripción del Pedido / Prendas</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Ejemplo: Confección de 50 camisas escolares tipo Polo con bordado institucional." required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha_entrega" class="form-label fw-bold">Fecha Comprometida de Entrega</label>
                    <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label fw-bold">Estado Inicial de Producción</label>
                    <select name="estado" id="estado" class="form-select" required>
                        <option value="Pendiente" selected>Pendiente</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="total" class="form-label fw-bold">Monto Total del Pedido ($)</label>
                    <input type="number" name="total" id="total" class="form-control" step="0.01" placeholder="0.00" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="saldo_pendiente" class="form-label fw-bold">Saldo Pendiente Inicial ($)</label>
                    <input type="number" name="saldo_pendiente" id="saldo_pendiente" class="form-control" step="0.01" placeholder="Se sugiere igualar al total si no hay anticipo" required>
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="/pedidos" class="btn btn-light border px-4" style="border-radius: 10px;">Cancelar</a>
                <button type="submit" class="btn btn-warning px-4" style="border-radius: 10px; font-weight: bold; color: #0b0b0b;">
                    <i class="bi bi-save-fill"></i> Guardar Pedido
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Pequeño script para automatizar que el saldo pendiente inicial se iguale al total automáticamente si el usuario no ha escrito nada -->
<script>
    document.getElementById('total').addEventListener('input', function() {
        const saldoInput = document.getElementById('saldo_pendiente');
        if(saldoInput.value === '') {
            saldoInput.value = this.value;
        }
    });
</script>

@endsection
