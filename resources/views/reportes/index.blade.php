@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-bar-chart-fill"></i>
        Reportes del Sistema
    </h1>
    <p class="text-muted">
        Consulta información general sobre ventas, gastos, ganancias y producción.
    </p>
</div>

<!-- GANANCIA NETA TOTAL -->
<div class="card card-dashboard mb-4">
    <div class="card-body text-center">
        <h5>
            <i class="bi bi-trophy-fill" style="color:#d4af37;"></i>
            Ganancia Neta Total
        </h5>
        <!-- CORREGIDO: Muestra la resta real acumulada de cobros menos bonos comerciales -->
        <h1 style="font-size:60px;font-weight:bold;">
            ${{ number_format($gananciaNetaTotal, 2) }}
        </h1>
    </div>
</div>

<!-- VENTAS -->
<h3 class="mt-4 mb-3">
    <i class="bi bi-cash-stack" style="color:#d4af37;"></i>
    Ventas
</h3>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Ventas Hoy</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($ventasHoy, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Ventas Semana</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($ventasSemana, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Ventas Mes</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($ventasMes, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Ventas Año</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($ventasAno, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- GASTOS -->
<h3 class="mt-4 mb-3">
    <i class="bi bi-wallet2" style="color:#d4af37;"></i>
    Gastos
</h3>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Gastos Semana</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($gastosSemana, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Gastos Mes</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($gastosMes, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Gastos Año</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($gastosAno, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- GANANCIAS -->
<h3 class="mt-4 mb-3">
    <i class="bi bi-piggy-bank-fill" style="color:#d4af37;"></i>
    Ganancias
</h3>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Ganancia Semana</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($gananciaSemana, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Ganancia Mes</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($gananciaMes, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard">
            <div class="card-body text-center">
                <h5>Ganancia Año</h5>
                <!-- CORREGIDO: Dinámico -->
                <h3>${{ number_format($gananciaAno, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- RESUMEN GENERAL -->
<h3 class="mt-4 mb-3">
    <i class="bi bi-clipboard-data-fill" style="color:#d4af37;"></i>
    Resumen General
</h3>

<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Indicador</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Pedidos Completados</td>
            <!-- CORREGIDO: Conteo dinámico real -->
            <td><span class="badge bg-success" style="font-size: 14px;">{{ $pedidosCompletados }}</span></td>
        </tr>
        <tr>
            <td>Pedidos Pendientes</td>
            <!-- CORREGIDO: Conteo dinámico real -->
            <td><span class="badge bg-warning text-dark" style="font-size: 14px;">{{ $pedidosPendientes }}</span></td>
        </tr>
        <tr>
            <td>Pedidos Cancelados</td>
            <!-- CORREGIDO: Conteo dinámico real -->
            <td><span class="badge bg-secondary" style="font-size: 14px;">{{ $pedidosCancelados }}</span></td>
        </tr>
        <tr>
            <td>Trabajadores Activos</td>
            <!-- CORREGIDO: Conteo dinámico real -->
            <td><strong>{{ $trabajadoresActivos }}</strong></td>
        </tr>
        <tr>
            <td>Bonos Entregados</td>
            <!-- CORREGIDO: Conteo dinámico real -->
            <td><span class="text-success fw-bold">{{ $bonosEntregados }}</span></td>
        </tr>
        <tr>
            <td>Usuarios Registrados</td>
            <!-- CORREGIDO: Conteo dinámico real -->
            <td><strong>{{ $usuariosRegistrados }}</strong></td>
        </tr>
    </tbody>
</table>

@endsection
