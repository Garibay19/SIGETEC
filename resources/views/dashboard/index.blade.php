@extends('layouts.app')

@section('contenido')

<h1 class="mb-4" style="font-size:50px;font-weight:bold;">
    Dashboard SIGETEC
</h1>
<p class="text-muted">Bienvenido al Sistema de Gestión para Confecciones Sofía.</p>

<div class="row mb-4">

    <!-- CLIENTES REGISTRADOS -->
    <div class="col-md-3">
        <div class="card card-dashboard text-center shadow-sm border-0 p-3" style="border-radius: 15px;">
            <div class="card-body">
                <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #d4af37; border-radius: 50%; color: white;">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
                <h5 class="text-muted" style="font-size: 16px;">Clientes Registrados</h5>
                <h1 style="font-size:45px; font-weight:bold; color: #212529;" class="mt-2">
                    {{ $totalClientes }}
                </h1>
            </div>
        </div>
    </div>

    <!-- PEDIDOS PENDIENTES -->
    <div class="col-md-3">
        <div class="card card-dashboard text-center shadow-sm border-0 p-3" style="border-radius: 15px;">
            <div class="card-body">
                <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #d4af37; border-radius: 50%; color: white;">
                    <i class="bi bi-bag-fill fs-4"></i>
                </div>
                <h5 class="text-muted" style="font-size: 16px;">Pedidos Pendientes</h5>
                <h1 style="font-size:45px; font-weight:bold; color: #212529;" class="mt-2">
                    {{ $pedidosPendientes }}
                </h1>
            </div>
        </div>
    </div>

    <!-- PAGOS PENDIENTES -->
    <div class="col-md-3">
        <div class="card card-dashboard text-center shadow-sm border-0 p-3" style="border-radius: 15px;">
            <div class="card-body">
                <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #d4af37; border-radius: 50%; color: white;">
                    <i class="bi bi-credit-card-fill fs-4"></i>
                </div>
                <h5 class="text-muted" style="font-size: 16px;">Pagos Pendientes</h5>
                <h1 style="font-size:45px; font-weight:bold; color: #212529;" class="mt-2">
                    {{ $pagosPendientes }}
                </h1>
            </div>
        </div>
    </div>

    <!-- GANANCIA DEL MES -->
    <div class="col-md-3">
        <div class="card card-dashboard text-center shadow-sm border-0 p-3" style="border-radius: 15px; border-bottom: 4px solid #d4af37 !important;">
            <div class="card-body">
                <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #d4af37; border-radius: 50%; color: white;">
                    <i class="bi bi-trophy-fill fs-4"></i>
                </div>
                <h5 class="text-muted" style="font-size: 16px;">Ganancia del Mes</h5>
                <h1 style="font-size:40px; font-weight:bold; color: #212529;" class="mt-2">
                    ${{ number_format($gananciaMes, 2) }}
                </h1>
            </div>
        </div>
    </div>

</div>

<!-- SECCIÓN INFERIOR: RESUMEN GENERAL -->
<div class="card shadow-sm border-0 mt-4" style="border-radius: 15px;">
    <div class="card-body p-4 text-center">
        <h3 class="mb-3" style="font-weight: bold;"><span style="color: #d4af37;">✨</span> Resumen General</h3>
        <p class="text-muted">Sistema de Gestión para Taller de Costura <strong>Confecciones Sofía</strong></p>
        
        <div class="text-start mt-4 mx-auto" style="max-width: 400px;">
            <p class="text-success"><i class="bi bi-check-circle-fill me-2"></i> Administración de Clientes</p>
        </div>
    </div>
</div>

@endsection
