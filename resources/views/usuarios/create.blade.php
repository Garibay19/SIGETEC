@extends('layouts.app')

@section('contenido')

<h1>Nuevo Usuario</h1>

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
        placeholder="Nombre del usuario">

    </div>


    <div class="mb-3">

        <label class="form-label">

            Correo electrónico

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


    <div class="mb-4">

        <label class="form-label">

            Rol

        </label>

        <select class="form-select">

            <option>

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

        Guardar

    </button>

    <a href="/usuarios"
    class="btn btn-secondary">

        Cancelar

    </a>

</form>
```

</div>

@endsection
