<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href={{ asset('css/admin/style.css') }}>
  <title>Agregar tecnico</title>
</head>

<body>
  <div class="containeradd">
    <h1 class="title">
      Agregar técnico
    </h1>

    <form action={{ route('newTecnico') }} method="POST">
      @csrf
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label title">Nombre: </label>
        <input placeholder="Agregar Nombre" type="text" class="form-control" id="examplenombre" name="name"
          aria-describedby="emailHelp">

      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label title">Apellido Paterno: </label>
        <input placeholder="Agregar Apellido Paterno" type="text" class="form-control" id="exampleapleiidooa"
          name="last_name">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label title">Apellido Materno: </label>
        <input placeholder="Agregar Apellido Materno" type="text" class="form-control" id="exampleapellidolastnam"
          name="mother_last_name">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label title">Usuario: </label>
        <input placeholder="Agregar Usuario" type="text" class="form-control" id="exampleusuario" name="username"
          aria-describedby="emailHelp">

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label title">Password: </label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>


      <div class="mb-3">

        @if (Session('erroform'))
          <p style="color: red">{{ Session('erroform') }}</p>
        @endif

        <button class="btn btn-light">Agregar tecnico</button>
    </form>
  </div>


</body>

</html>
