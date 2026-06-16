@extends('layouts.app')

@section('contenido')

<h1>Editar Cliente</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre completo</label>
                <input type="text" class="form-control" value="Juan Pérez">
            </div>

            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" class="form-control" value="2411234567">
            </div>

            <div class="mb-3">
                <label>Dirección</label>
                <input type="text" class="form-control" value="Apizaco, Tlaxcala">
            </div>

            <div class="mb-3">
                <label>Correo</label>
                <input type="email" class="form-control" value="juan@gmail.com">
            </div>

            <div class="mb-3">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3">Cliente frecuente</textarea>
            </div>

            <button class="btn btn-success">Actualizar</button>
            <a href="/clientes" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

@endsection