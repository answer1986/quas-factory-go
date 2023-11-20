<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quas Factory</title>
    <link href="{{asset('css/app.css') }}" rel="stylesheet">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
<div id="app" class="g-col">
    <h1 id="Nombre-app" class="text-center mb-4">Quas Factory</h1>
    <h2 id="login" class="text-center mb-4">Iniciar Sesión</h2>
    <div class="overlay-text">Tu empresa creciendo en la direccion correcta, excelencia en la gestión y conformidad reglamentaria.</div>

    <div class="row justify-content-center">
    <div class="col-md-6">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group text-center">
            <button id="submit" type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </div>
        <div class="form-group text-center">
            <a href="{{ route('password.request') }}" class="text-muted">¿Olvidaste tu contraseña?</a>
        </div>
    </form>
    <!-- Mostrar Errores de Validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    </div>
</div>
    <div class="row" id="pie-login">
        <div class="col-md-4">
        <a href="https://quas.cl" id="pie1" >Nuestra web</a>
        </div>
        <div class="col-md-4">
          <a id="pie1">Otros Productos</a> 
        </div>
        <div class="col-md-4">
          <a href="https://quas.cl/nuestros_servicios"id="pie1">Certificaciones iso </a>
        </div>

    </div>
</div>



</body>
<!-- Scripts JS de Bootstrap (y dependencias) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>