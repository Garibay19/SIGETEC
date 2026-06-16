@extends('layouts.app')

@section('contenido')

<h1>Nueva Máquina</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Máquina Recta">
            </div>

            <div class="mb-3">
                <label>Marca</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Juki">
            </div>

            <div class="mb-3">
                <label>Modelo</label>
                <input type="text" class="form-control" placeholder="Ejemplo: DDL-8700">
            </div>

            <div class="mb-3">
                <label>Estado</label>

                <select class="form-control">
                    <option>Operando</option>
                    <option>En mantenimiento</option>
                    <option>Fuera de servicio</option>
                </select>

            </div>

            <div class="mb-3">
                <label>Fecha de adquisición</label>
                <input type="date" class="form-control">
            </div>

            <button class="btn btn-success">
                Guardar
            </button>

            <a href="/maquinaria" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection