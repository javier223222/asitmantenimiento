<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <link rel="stylesheet" href={{ asset('css/admin/tecnico/addequipo/style.css') }}>
  <style>
    body {
      color: white
    }
  </style>
  <title>Agregar equipo</title>
</head>

<body>
  <h1 style="color: white">Agregar Equipo</h1>
  <form action="{{ route('newequipo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
      <label style="color: white" class="col-sm-2 col-form-label">Folio del equipo</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese el folio del producto" name="folioproducto"
          style="background-color:
                white" type="text" class="form-control" required>
      </div>
    </div>
    <div class="form-group row">
      <label style="color: white" class="col-sm-2 col-form-label">Foto del Equipo</label>
      <div class="col-sm-10">
        <input type="file" class="form-control-file" name="fileproducto" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Nombre del Equipo:</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese el nombre del producto" name="nombreproducto"
          style="background-color:
             white" type="text" class="form-control" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Descripcion del Equipo:</label>
      <div class="col-sm-10">
        <textarea name="descripcionequi" class="form-control" id="descripciomdelequipo" rows="3" required></textarea>

      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Descripcion del problema Equipo:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="descripcionproblema" id="descripcionprobequipo" rows="3" required></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Marca del Equipo:</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese la marca del producto" name="marcaequipo" style="background-color: white"
          type="text" class="form-control" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Categoria del producto:</label>
      <div class="col-sm-10">
        <select name="categoria" id="inputState" class="form-control" required>
          <option value="0" selected>Elige la categoria</option>
          <option value="1">Tabletas</option>
          <option value="2">Computadoras</option>
          <option value="3">Telefonos</option>
          <option value="4">Accesorios</option>
          <option value="5">Impresoras</option>
          <option value="6">Televisores</option>
          <option value="7">Otro</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Nombre del cliente:</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese el nombre del cliente" name="nombrecliente" style="background-color: white"
          type="text" class="form-control" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Apellido Paterno del cliente:</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese el Apellido paterno " name="apellidopcli" style="background-color: white"
          type="text" class="form-control" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Apellido Materno del cliente:</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese el Apellido materno " name="apellidomcli" style="background-color: white"
          type="text" class="form-control" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Correo electronico del cliente:</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese el correo electronico del cliente " name="emailclien"
          style="background-color: white" type="email" class="form-control" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Numero de telefono del cliente:</label>
      <div class="col-sm-10">
        <input placeholder="Ingrese el numero de telefono del cliente " name="telefonoclien"
          style="background-color: white" type="text" class="form-control" required>
      </div>
    </div>

    <button class="btn btn-light">Agregar</button>

  </form>
  @if (session('erroradprud'))
    <p style="color:red">{{ session('erroradprud') }}</p>
  @endif


</body>

</html>
