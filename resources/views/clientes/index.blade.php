{{--estamos usando el diseño principal que hice en app.lade.php--}}
@extends('layouts.app')

{{--Lo que este aquise coloca donde esta @yield('contenido')en el layout--}}
@section('contenido')

<h1>Clientes</h1>

<a href="/clientes/create" class="btn btn-primary mb-3">
    Nuevo Cliente
</a>

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
                    Editar
                </a>
        </tr>

    </tbody>

</table>

@endsection