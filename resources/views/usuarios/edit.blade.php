@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-pencil-square"
    style="color:#d4af37;"></i>

    Editar Usuario

</h1>

<p class="text-muted">

    Modifica la información del usuario seleccionado.

</p>

</div>

<div class="card shadow p-4">

<form>

    <div class="mb-3">

        <label class="form-label">

            Nombre Completo

        </label>

        <input
        type="text"
        class="form-control"
        value="Sofía">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Correo Electrónico

        </label>

        <input
        type="email"
        class="form-control"
        value="sofia@sigetec.com">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Nueva Contraseña

        </label>

        <input
        type="password"
        class="form-control"
        placeholder="Escribe una nueva contraseña">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Rol

        </label>

        <select class="form-select">

            <option selected>Administrador</option>

            <option>Supervisor</option>

            <option>Empleado</option>

        </select>

    </div>

    <div class="mb-4">

        <label class="form-label">

            Estado

        </label>

        <select class="form-select">

            <option selected>Activo</option>

            <option>Inactivo</option>

        </select>

    </div>

    <button class="btn btn-success">

        <i class="bi bi-check-circle-fill"></i>
        Actualizar

    </button>

    <button class="btn btn-danger">

        <i class="bi bi-trash-fill"></i>
        Eliminar Usuario

    </button>

    <a href="/usuarios"
    class="btn btn-secondary">

        <i class="bi bi-x-circle-fill"></i>
        Cancelar

    </a>

</form>

</div>

@endsection
