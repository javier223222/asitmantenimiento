<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/cliente/style.css') }}">
  <title>Home</title>
</head>

<body>
  <div class="container-fluid text-center">
    <div class="row align-items-center">
      <div class="col clientside">
        <img src="/images/asitw.png" alt="ASIT" width="250" height="150" class="mt-5">
        <h1 class="my-5">
          ¿Eres un cliente?
        </h1>
        <h2>
          Revisa el estado de tu equipo aqui:
        </h2>
        <a href="{{ route('buscarequipo') }}" class="btn clientbtn mt-5">BUSCAR</a>
      </div>
      <div class="col adminside">
        <img src="/images/asitw.png" alt="ASIT" width="250" height="150" class="mt-5">
        <h1 class="my-5">
          ¿Eres un administrador?
        </h1>
        <h2>
          Inicia sesión aqui:
        </h2>
        </h2>
        <a href="{{ route('loginA') }}" class="btn adminbtn mt-5">ACCEDER</a>
      </div>
      </div>
    </div>
  </div>
</body>

</html>
