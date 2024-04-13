<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Agregar tecnico</title>
</head>
<body>

    <form action={{route("newTecnico")}} method="POST">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nombre</label>
          <input placeholder="Agregar nombre" type="text" class="form-control" id="examplenombre" name="name" aria-describedby="emailHelp">

        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Apellido Paterno</label>
          <input placeholder="Agregar apellido paterno" type="text"  class="form-control" id="exampleapleiidooa" name="last_name">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Apellido Materno</label>
            <input placeholder="Agregar apellido Materno" type="text"  class="form-control" id="exampleapellidolastnam"
            name="mother_last_name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Usuario</label>
            <input placeholder="Agreagr Usuario" type="text" class="form-control" id="exampleusuario" name="username" aria-describedby="emailHelp">

          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
          </div>


        <div class="mb-3">

            @if (Session("erroform"))
            <p style="color: red" >{{Session("erroform")}}</p>

            @endif

        <button  class="btn btn-primary">Agregar tecnico</button>
      </form>

</body>
</html>
