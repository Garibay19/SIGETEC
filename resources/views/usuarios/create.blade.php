@extends('layouts.app')

@section('contenido')

<div class="mb-4">

<h1 style="font-weight:bold;">

    <i class="bi bi-person-plus-fill"
    style="color:#d4af37;"></i>

    Nuevo Usuario

</h1>

<p class="text-muted">

    Registra un nuevo usuario en el sistema.

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
        placeholder="Nombre del usuario">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Correo Electrónico

        </label>

        <input
        type="email"
        class="form-control"
        placeholder="correo@ejemplo.com">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Contraseña

        </label>

        <input
        type="password"
        class="form-control"
        placeholder="********">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Rol

        </label>

        <select class="form-select">

            <option>Administrador</option>

            <option>Supervisor</option>

            <option>Empleado</option>

        </select>

    </div>

    <div class="mb-4">

        <label class="form-label">

            Estado

        </label>

        <select class="form-select">

            <option>Activo</option>

            <option>Inactivo</option>

        </select>

    </div>

    <button class="btn btn-success">

        <i class="bi bi-check-circle-fill"></i>
        Guardar

    </button>

    <a href="/usuarios"
    class="btn btn-secondary">

        <i class="bi bi-x-circle-fill"></i>
        Cancelar

    </a>

</form>

</div>

@endsection
