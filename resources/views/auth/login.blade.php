<!DOCTYPE html>
<html lang="es">

<head>

   <!DOCTYPE html>

<html lang="es">

<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - SIGETEC</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

    body{

        background:linear-gradient(135deg,#0b0b0b,#2b2b2b);

        height:100vh;

        display:flex;

        justify-content:center;

        align-items:center;

    }

    .login-card{

        width:430px;

        background:white;

        border-radius:25px;

        box-shadow:0 10px 35px rgba(0,0,0,.35);

        padding:35px;

    }

    .logo{

        width:180px;

        border-radius:50%;

        border:4px solid #c89b3c;

    }

    .empresa{

        color:#c89b3c;

        font-weight:bold;

        font-size:20px;

    }

    .btn-login{

        background:#c89b3c;

        color:white;

        border:none;

        border-radius:12px;

        padding:12px;

        width:100%;

        font-size:18px;

        transition:.3s;

    }

    .btn-login:hover{

        background:#b07d1f;

        transform:translateY(-2px);

    }

    .form-control{

        border-radius:12px;

    }

</style>


</head>

<body>

<div class="login-card">


<div class="text-center">

    <img src="{{ asset('img/logo.jpg') }}"
    class="logo">

    <h1 class="mt-3">

        SIGETEC

    </h1>

    <div class="empresa">

        Confecciones Sofía

    </div>

</div>

<hr>

<form action="/dashboard">

    <div class="mb-3">

        <label class="form-label">

            Correo electronico

        </label>

        <input

        type="email"

        class="form-control"

        placeholder="correo@empresa.com">

    </div>


    <div class="mb-4">

        <label class="form-label">

            Contraseña

        </label>

        <input

        type="password"

        class="form-control"

        placeholder="********">

    </div>


    <button class="btn-login">

        Iniciar Sesión

    </button>

    <div class="text-center mt-3">

    <a href="#"
    class="text-decoration-none">

        ¿Olvidaste tu contraseña?

    </a>

</div>

</form>

</div>

</body>

</html>
