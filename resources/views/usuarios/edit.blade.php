@extends('layouts.app')

@section('contenido')

<h1>Editar Usuario</h1>

<div class="card shadow p-4">

```
<form>

    <div class="mb-3">

        <label class="form-label">

            Nombre completo

        </label>

        <input
        type="text"
        class="form-control"
        value="Sofía">

    </div>


    <div class="mb-3">

        <label class="form-label">

            Correo electrónico

        </label>

        <input
        type="email"
        class="form-control"
        value="sofia@sigetec.com">

    </div>


    <div class="mb-3">

        <label class="form-label">

            Nueva contraseña

        </label>

        <input
        type="password"
        class="form-control"
        placeholder="Escribe una nueva contraseña">

    </div>


    <div class="mb-4">

        <label class="form-label">

            Rol

        </label>

        <select class="form-select">

            <option selected>

                Administrador

            </option>

            <option>

                Usuario

            </option>

            <option>

                Temporal

            </option>

        </select>

    </div>


    <button class="btn btn-success">

        Actualizar

    </button>

    <button class="btn btn-danger">

        Eliminar Usuario

    </button>

    <a href="/usuarios"
    class="btn btn-secondary">

        Cancelar

    </a>

</form>
```

</div>

@endsection
