@extends('layouts.app')

@section('contenido')

<h1>Editar Máquina</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" value="Máquina Recta">
            </div>

            <div class="mb-3">
                <label>Marca</label>
                <input type="text" class="form-control" value="Juki">
            </div>

            <div class="mb-3">
                <label>Modelo</label>
                <input type="text" class="form-control" value="DDL-8700">
            </div>

            <div class="mb-3">
                <label>Estado</label>

                <select class="form-control">
                    <option selected>Operando</option>
                    <option>En mantenimiento</option>
                    <option>Fuera de servicio</option>
                </select>

            </div>

            <div class="mb-3">
                <label>Fecha de adquisición</label>
                <input type="date" class="form-control" value="2025-03-10">
            </div>

            <button class="btn btn-success">
                Actualizar
            </button>

            <a href="/maquinaria" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection