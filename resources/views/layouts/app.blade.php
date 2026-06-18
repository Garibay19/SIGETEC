<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGETEC</title>


<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

    body{
        background:#f5f5f5;
    }

    /* SIDEBAR */

    .sidebar{

        min-height:100vh;

        width:250px;

        background:#0b0b0b;

        box-shadow:3px 0 20px rgba(0,0,0,.2);

    }

    .sidebar a{

        color:white;

        text-decoration:none;

        display:block;

        padding:15px 20px;

        margin:8px;

        border-radius:12px;

        font-size:18px;

        transition:.3s;

    }

    .sidebar a:hover{

        background:#c89b3c;

        color:white;

    }

    .logo{

        width:170px;

        border-radius:50%;

        border:3px solid #c89b3c;

    }

    .nombre-empresa{

        color:#c89b3c;

        font-size:18px;

    }

    .sidebar hr{

        border:1px solid #c89b3c;

    }

    /* CONTENIDO */

    .contenido{

        padding:30px;

    }

    /* TARJETAS */

    .card-dashboard{

        border:none;

        border-bottom:4px solid #c89b3c;

        border-radius:15px;

        box-shadow:0 5px 20px rgba(0,0,0,.08);

        transition:.3s;

    }

    .card-dashboard:hover{

        transform:translateY(-5px);

    }

    .card-dashboard{
        cursor: pointer;
    }

    .icono{

        width:70px;

        height:70px;

        border-radius:50%;

        background:#c89b3c;

        color:white;

        display:flex;

        justify-content:center;

        align-items:center;

        margin:auto;

        font-size:35px;

    }

    .table{
        background:white;
        border-radius:10px;
        overflow:hidden;
    }
    
    .table thead th{
        background-color:#0b0b0b !important;
        color:#d4af37 !important;
        border-color:#0b0b0b !important;
    }
    
    .table tbody tr:hover{
        background-color:#fff3cd !important;
        cursor:pointer;
        transition:0.3s;
    }

</style>

</head>

<body>

<div class="container-fluid">

<div class="row">

    <!-- SIDEBAR -->

    <div class="sidebar col-auto">

        <div class="text-center mt-3 mb-3">

            <img src="{{ asset('img/logo.jpg') }}"
            class="logo">

            <h1 class="text-white mt-3">

                SIGETEC

            </h1>

            <div class="nombre-empresa">

                Confecciones Sofía

            </div>

        </div>

        <hr>

        <a href="/dashboard">
            <i class="bi bi-house-fill"></i>
            &nbsp;
            Dashboard
        </a>

        <a href="/clientes">
            <i class="bi bi-people-fill"></i>
            &nbsp;
            Clientes
        </a>

        <a href="/pedidos">
            <i class="bi bi-bag-fill"></i>
            &nbsp;
            Pedidos
        </a>

        <a href="/pagos">
            <i class="bi bi-credit-card-fill"></i>
            &nbsp;
            Pagos
        </a>

        <a href="/trabajadores">
            <i class="bi bi-person-fill"></i>
            &nbsp;
            Trabajadores
        </a>

        <a href="/bonos">
            <i class="bi bi-gift-fill"></i>
            &nbsp;
            Bonos
        </a>

        <a href="/materiales">
            <i class="bi bi-box-seam"></i>
            &nbsp;
            Materiales
        </a>

        <a href="/maquinaria">
            <i class="bi bi-gear-fill"></i>
            &nbsp;
            Maquinaria
        </a>

        <a href="/reportes">
            <i class="bi bi-bar-chart-fill"></i>
            &nbsp;
            Reportes
        </a>

        <a href="/usuarios">
            <i class="bi bi-person-gear"></i>
            &nbsp;
            Usuarios
        </a>

    </div>

    <!-- CONTENIDO -->

 <div class="col contenido">

    <!-- HEADER -->

    <div class="d-flex justify-content-end align-items-center mb-4">

        <div class="text-end">

            <h5 class="mb-0">

                👤 Sofía

            </h5>

            <small class="text-muted">

                Administrador

            </small>

        </div>

        <a href="/"
        class="btn btn-outline-dark ms-3">

            Cerrar Sesión

        </a>

    </div>


    @yield('contenido')

</div>

</div>


</div>

</body>

</html>
