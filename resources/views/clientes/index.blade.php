<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  
  <title>Buscar Equipo</title>
</head>

<body>
  <div>
    <h1>Asit</h1>
    <h1>Mantenimiento seguro</h1>

  </div>
  @if (session('errosearch'))
    <p style="color: red">{{ session('errosearch') }}</p>
  @endif

  <div>
    <form action="{{ route('buscarequipo') }}" method="post">
      @csrf
      <input placeholder="ingrese el folio" type="text" name="folio" id="serial">
      <input placeholder="ingrese el numero" type="text" name="numero">
      <button>Buscar</button>
    </form>

  </div>


</body>

</html>
