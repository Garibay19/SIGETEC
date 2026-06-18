@extends('layouts.app')

@section('contenido')

<h1 class="mb-2" style="font-size:50px;font-weight:bold;">

Dashboard SIGETEC

</h1>

<p class="text-muted mb-4">

Bienvenido al Sistema de Gestión para Confecciones Sofía.


</p>

<div class="row g-4">

<!-- CLIENTES -->

<div class="col-md-3">

    <div class="card card-dashboard">

        <div class="card-body text-center">

            <div class="icono">
                <i class="bi bi-people-fill"></i>
            </div>

            <br>

            <h5>Clientes Registrados</h5>

            <h1 style="font-size:50px;font-weight:bold;">
                125
            </h1>

        </div>

    </div>

</div>

<!-- PEDIDOS -->

<div class="col-md-3">

    <div class="card card-dashboard">

        <div class="card-body text-center">

            <div class="icono">
                <i class="bi bi-bag-fill"></i>
            </div>

            <br>

            <h5>Pedidos Pendientes</h5>

            <h1 style="font-size:50px;font-weight:bold;">
                18
            </h1>

        </div>

    </div>

</div>

<!-- PAGOS -->

<div class="col-md-3">

    <div class="card card-dashboard">

        <div class="card-body text-center">

            <div class="icono">
                <i class="bi bi-cash-stack"></i>
            </div>

            <br>

            <h5>Pagos Pendientes</h5>

            <h1 style="font-size:50px;font-weight:bold;">
                12
            </h1>

        </div>

    </div>

</div>

<!-- GANANCIA -->

<div class="col-md-3">

    <div class="card card-dashboard">

        <div class="card-body text-center">

            <div class="icono">
                <i class="bi bi-trophy-fill"></i>
            </div>

            <br>

           <h5>Ganancia del Mes</h5>

<h1 style="font-size:50px;font-weight:bold;">
    $48,300
</h1>
        </div>

    </div>

</div>

</div>

<br>

<div class="card card-dashboard">

<div class="card-body">

    <h3 class="text-center mb-4">

        <i class="bi bi-stars"
        style="color:#d4af37;"></i>

        Resumen General

    </h3>

    <p class="text-center text-muted">

        Sistema de Gestión para Taller de Costura
        <strong>Confecciones Sofía</strong>

    </p>

    <ul class="list-group list-group-flush mt-4">

        <li class="list-group-item">
            <i class="bi bi-check-circle-fill text-success"></i>
            Administración de Clientes
        </li>

        <li class="list-group-item">
            <i class="bi bi-check-circle-fill text-success"></i>
            Gestión de Pedidos
        </li>

        <li class="list-group-item">
            <i class="bi bi-check-circle-fill text-success"></i>
            Control de Pagos
        </li>

        <li class="list-group-item">
            <i class="bi bi-check-circle-fill text-success"></i>
            Administración de Trabajadores y Bonos
        </li>

        <li class="list-group-item">
            <i class="bi bi-check-circle-fill text-success"></i>
            Control de Materiales e Inventario
        </li>

        <li class="list-group-item">
            <i class="bi bi-check-circle-fill text-success"></i>
            Gestión de Maquinaria
        </li>

        <li class="list-group-item">
            <i class="bi bi-check-circle-fill text-success"></i>
            Reportes Financieros y Operativos
        </li>

    </ul>

</div>


</div>


@endsection
