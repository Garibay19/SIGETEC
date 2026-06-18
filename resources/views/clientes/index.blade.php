{{--estamos usando el diseño principal que hice en app.lade.php--}}
@extends('layouts.app')

{{--Lo que este aquise coloca donde esta @yield('contenido')en el layout--}}
@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-people-fill"></i>

        Gestión de Clientes

    </h1>

    <p class="text-muted">

        Administra la información de los clientes registrados.

    </p>

</div>

<div class="d-flex justify-content-between align-items-center mb-3">

    <input
    type="text"
    class="form-control w-50"
    placeholder="Buscar cliente...">

    <a href="/clientes/create"
    class="btn btn-warning">

        <i class="bi bi-people-fill"></i>
        Nuevo Cliente

    </a>

</div>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>Juan Pérez</td>
            <td>2411234567</td>
            <td>Apizaco, Tlaxcala</td>
            <td>juan@gmail.com</td>

            <td>
                <a href="/clientes/edit" class="btn btn-warning btn-sm">
        <i class="bi bi-pencil-fill"></i>
                    Editar
                </a>

                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?')">
                    <i class="bi bi-trash-fill"></i>
                    Eliminar
                </button>
            </td>    

        </tr>

    </tbody>

</table>

@endsection