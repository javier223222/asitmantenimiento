<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href={{ asset('css/admin/style.css') }}>
  <title>Actualizar Tecnico</title>
</head>

<body>
  <div class="containeradd">
    <h1 class="title">Actualizar técnico</h1>

    <form action={{ route('actualizarTecnico', ['id' => $admin->id]) }} method="POST">
      @csrf
      @method('PATCH')
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label title">ID: </label>
        <input class="form-control" type="text" value={{ $admin->id }} readonly>

      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label title">Nombre: </label>
        <input type="text" class="form-control" id="examplenombre" name="nameup" value={{ $admin->name }}>

      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label title">Apellido Paterno: </label>
        <input placeholder="Agregar apellido paterno" type="text" value={{ $admin->last_name }} class="form-control"
          id="exampleapleiidooa" name="last_nameup">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label title">Apellido Materno: </label>
        <input placeholder="Agregar apellido Materno" type="text" value={{ $admin->mother_last_name }}
          class="form-control" id="exampleapellidolastnam" name="mother_last_nameup">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label title">Usuario: </label>
        <input placeholder="Agreagr Usuario" type="text" class="form-control" value={{ $admin->username }}
          id="exampleusuario" name="usernameup" aria-describedby="emailHelp">

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label title">Password: </label>
        <input type="text" class="form-control" value={{ $admin->password_text }} id="exampleInputPassword1"
          name="passwordup">
      </div>


      <div class="mb-3">

        @if (Session('erroformup'))
          <p style="color: red">{{ Session('erroformup') }}</p>
        @endif

        <button class="btn btn-light">Actualizar técnico</button>
    </form>
  </div>

</body>

</html>
