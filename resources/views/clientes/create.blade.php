@extends('layouts.app')

@section('contenido')

<h1>Nuevo Cliente</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre completo</label>
                <input type="text" class="form-control" placeholder="Ingrese el nombre completo">
            </div>

            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" class="form-control" placeholder="Ingrese el teléfono">
            </div>

            <div class="mb-3">
                <label>Dirección</label>
                <input type="text" class="form-control" placeholder="Ingrese la dirección">
            </div>

            <div class="mb-3">
                <label>Correo</label>
                <input type="email" class="form-control" placeholder="Ingrese el correo">
            </div>

            <div class="mb-3">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3"></textarea>
            </div>

            <button class="btn btn-success">Guardar</button>
            <a href="/clientes" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

@endsection