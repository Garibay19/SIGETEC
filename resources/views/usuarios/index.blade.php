@extends('layouts.app')

@section('contenido')

<div class="mb-4">

    <h1 style="font-weight:bold;">

        <i class="bi bi-person-badge-fill"></i>

        Gestión de Usuarios

    </h1>

    <p class="text-muted">

        Administra los usuarios autorizados para acceder al sistema.

    </p>

</div>


<div class="text-end mb-3">

    <a href="/usuarios/create"
    class="btn btn-warning">
<i class="bi bi-person-badge-fill"></i>
        Nuevo Usuario

    </a>

</div>

<table class="table table-striped">

<thead>

    <tr>

        <th>ID</th>

        <th>Nombre</th>

        <th>Correo</th>

        <th>Rol</th>

        <th>Estado</th>

        <th>Acciones</th>

    </tr>

</thead>


<tbody>

    <tr>

        <td>1</td>

        <td>Sofía</td>

        <td>sofia@sigetec.com</td>

        <td>

            <span class="badge bg-danger">

                Administrador

            </span>

        </td>

            <td>
                <a href="/usuarios/edit" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                    Editar
                </a>

                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?')">
                    <i class="bi bi-trash-fill"></i>
                    Eliminar
                </button>
            </td>  

    </tr>


    <tr>

        <td>2</td>

        <td>Hermano</td>

        <td>hermano@sigetec.com</td>

        <td>

            <span class="badge bg-primary">

                Usuario

            </span>

        </td>

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
