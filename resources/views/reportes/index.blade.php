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

            <i class="bi bi-trophy-fill"
            style="color:#d4af37;"></i>

            Ganancia Neta Total

        </h5>

        <h1 style="font-size:60px;font-weight:bold;">

            $380,000

        </h1>

    </div>

</div>

<!-- VENTAS -->

<h3 class="mt-4 mb-3">

    <i class="bi bi-cash-stack"
    style="color:#d4af37;"></i>

    Ventas

</h3>

<div class="row">

    <div class="col-md-3 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Ventas Hoy</h5>

                <h3>$2,500</h3>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Ventas Semana</h5>

                <h3>$12,500</h3>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Ventas Mes</h5>

                <h3>$48,300</h3>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Ventas Año</h5>

                <h3>$520,000</h3>

            </div>

        </div>

    </div>

</div>

<!-- GASTOS -->

<h3 class="mt-4 mb-3">

    <i class="bi bi-wallet2"
    style="color:#d4af37;"></i>

    Gastos

</h3>

<div class="row">

    <div class="col-md-4 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Gastos Semana</h5>

                <h3>$3,200</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Gastos Mes</h5>

                <h3>$15,200</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Gastos Año</h5>

                <h3>$140,000</h3>

            </div>

        </div>

    </div>

</div>

<!-- GANANCIAS -->

<h3 class="mt-4 mb-3">

    <i class="bi bi-piggy-bank-fill"
    style="color:#d4af37;"></i>

    Ganancias

</h3>

<div class="row">

    <div class="col-md-4 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Ganancia Semana</h5>

                <h3>$9,300</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Ganancia Mes</h5>

                <h3>$33,100</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-4">

        <div class="card card-dashboard">

            <div class="card-body text-center">

                <h5>Ganancia Año</h5>

                <h3>$380,000</h3>

            </div>

        </div>

    </div>

</div>

<!-- RESUMEN GENERAL -->

<h3 class="mt-4 mb-3">

    <i class="bi bi-clipboard-data-fill"
    style="color:#d4af37;"></i>

    Resumen General

</h3>

<table class="table table-striped">

    <thead>

        <tr>

            <th>Indicador</th>
            <th>Valor</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>Pedidos Completados</td>
            <td>125</td>

        </tr>

        <tr>

            <td>Pedidos Pendientes</td>
            <td>18</td>

        </tr>

        <tr>

            <td>Pedidos Cancelados</td>
            <td>5</td>

        </tr>

        <tr>

            <td>Trabajadores Activos</td>
            <td>10</td>

        </tr>

        <tr>

            <td>Bonos Entregados</td>
            <td>25</td>

        </tr>

        <tr>

            <td>Usuarios Registrados</td>
            <td>3</td>

        </tr>

    </tbody>

</table>

@endsection