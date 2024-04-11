<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href={{ asset('css/adminormal/style.css') }}>
  <title>Admin</title>
</head>
<body>

<nav style="background-color: #1F1F29" class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand">
        <img src="/images/asitw.png" alt="ASIT" width="80" height="45">
      </a>
      <div class="mx-auto">
        <h1 class="navbar-text title">Equipos en servicio</h1>
      </div>
      <div class="d-flex gap-3">
        <form action="{{ route('logoutA') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn_blue" style="margin">SALIR</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100 w-50">
      <img src="/images/ejemplo.jpg" class="card-img-top" alt="..."  width="100" height="120">
      <div class="card-body">
        <h5 class="card-title">ID: XXXXXX</h5>
        <p class="card-text">Estatus: En mantenimiento</p>
      </div>
      <div class="card-footer">
      <div class="contendor-botones">
      <button type="button" class="btn-btn-sm-1 ">Comentar</button>
      <button type="button" class="btn-btn-sm-2 ">Actualizar</button>
      </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 w-50">
      <img src="/images/ejemplo.jpg" class="card-img-top" alt="..."  width="100" height="120">
      <div class="card-body">
        <h5 class="card-title">ID: XXXXXX</h5>
        <p class="card-text">Estatus: En fila</p>
      </div>
      <div class="card-footer">
      <div class="contendor-botones">
      <button type="button" class="btn-btn-sm-1 ">Comentar</button>
      <button type="button" class="btn-btn-sm-2 ">Actualizar</button>
      </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 w-50">
      <img src="/images/ejemplo.jpg" class="card-img-top" alt="..."  width="100" height="120">
      <div class="card-body">
        <h5 class="card-title">ID: XXXXXX</h5>
        <p class="card-text">Estatus: Lista</p>
      </div>
      <div class="card-footer">
      <div class="contendor-botones">
      <button type="button" class="btn-btn-sm-1 ">Comentar</button>
      <button type="button" class="btn-btn-sm-2 ">Actualizar</button>
      </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
