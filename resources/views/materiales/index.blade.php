@extends('layouts.app')

@section('contenido')

<h1>Materiales</h1>

<a href="/materiales/create" class="btn btn-primary mb-3">
    Nuevo Material
</a>

<table class="table table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Material</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Unidad</th>
            <th>Proveedor</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>Tela Mezclilla</td>
            <td>Tela</td>
            <td>50</td>
            <td>Metros</td>
            <td>Textiles Puebla</td>

            <td>
                <a href="/materiales/edit" class="btn btn-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>

    </tbody>

</table>

@endsection