
{{--el diseño de app.blade.php--}}

@extends('layouts.app')

{{--lo que escriba aqui, ira donde esta @yield ('contenido')--}}
@section('contenido')


<h1 class="mb-4" style="font-size:50px;font-weight:bold;">

Dashboard SIGETEC

</h1>

<div class="row">

<!-- CLIENTES -->

<div class="col-md-4">

    <div class="card card-dashboard">

        <div class="card-body text-center">

            <div class="icono">

                <i class="bi bi-people-fill"></i>

            </div>

            <br>

            <h3>

                Clientes

            </h3>

            <h1 style="font-size:55px;font-weight:bold;">

                0

            </h1>

        </div>

    </div>

</div>


<!-- PEDIDOS -->

<div class="col-md-4">

    <div class="card card-dashboard">

        <div class="card-body text-center">

            <div class="icono">

                <i class="bi bi-bag-fill"></i>

            </div>

            <br>

            <h3>

                Pedidos

            </h3>

            <h1 style="font-size:55px;font-weight:bold;">

                0

            </h1>

        </div>

    </div>

</div>


<!-- PAGOS -->

<div class="col-md-4">

    <div class="card card-dashboard">

        <div class="card-body text-center">

            <div class="icono">

                <i class="bi bi-credit-card-fill"></i>

            </div>

            <br>

            <h3>

                Pagos

            </h3>

            <h1 style="font-size:55px;font-weight:bold;">

                0

            </h1>

        </div>

    </div>

</div>


</div>

@endsection
