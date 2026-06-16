@extends('layouts.app')

@section('contenido')

<h1>Usuarios del Sistema</h1>

<a href="/usuarios/create"
class="btn btn-primary mb-3">

```
Nuevo Usuario
```

</a>

<table class="table table-striped">

```
<thead>

    <tr>

        <th>ID</th>

        <th>Nombre</th>

        <th>Correo</th>

        <th>Rol</th>

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

            <a href="/usuarios/edit"
            class="btn btn-warning btn-sm">

                Editar

            </a>

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

            <a href="/usuarios/edit"
            class="btn btn-warning btn-sm">

                Editar

            </a>

        </td>

    </tr>

</tbody>
```

</table>

@endsection
