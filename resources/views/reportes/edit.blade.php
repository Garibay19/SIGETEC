@extends('layouts.app')

@section('contenido')

<h1>Editar Reporte</h1>

<div class="card">
    <div class="card-body">

        <form>

            <div class="mb-3">
                <label>Tipo de reporte</label>

                <select class="form-control">
                    <option selected>Reporte de ventas</option>
                    <option>Reporte de pedidos</option>
                    <option>Reporte de pagos</option>
                    <option>Reporte de trabajadores</option>
                    <option>Reporte de materiales</option>
                </select>

            </div>

            <div class="mb-3">
                <label>Fecha inicial</label>
                <input type="date" class="form-control" value="2026-06-01">
            </div>

            <div class="mb-3">
                <label>Fecha final</label>
                <input type="date" class="form-control" value="2026-06-15">
            </div>

            <div class="mb-3">
                <label>Generado por</label>
                <input type="text" class="form-control" value="Administrador">
            </div>

            <button class="btn btn-success">
                Actualizar
            </button>

            <a href="/reportes" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>
</div>

@endsection