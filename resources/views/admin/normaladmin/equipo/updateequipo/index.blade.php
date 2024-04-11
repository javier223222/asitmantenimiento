<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href={{ asset('css/admin/tecnico/addequipo/style.css') }}>
    <title>Actualizar equipo</title>
    <style>
        body{
            color: #f1f1f1;
        }
    </style>
</head>
<body>
    @if (session('errorupdate'))
        <div class="alert alert-success">
           <p style="color: red">{{session('errorupdate')}}</p>
        </div>

    @endif
  <form action="{{route("updatemetho")}}" method="POST"  enctype="multipart/form-data">
    @method("PATCH")
    @csrf

    <h1>foto del equipo</h1>
  <label for="file">
  <h1>cambiar</h1>
  </label>
    <input type="text" name="id" value="{{$mantenimiento->foliId}}" style="visibility: hidden">
  <input name="newimage" type="file" id="file">
  <div class="form-check">
    <input onclick="calc();" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="En fila" checked>
    <label class="form-check-label" for="exampleRadios1">
        En proceso de verificacion
    </label>
  </div>
  <div class="form-check">
    <input onclick="calc();" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="En Mantenimiento">
    <label class="form-check-label" for="exampleRadios2">
        En proceso de reparacion
    </label>
  </div>
  <div class="form-check">
    <input onclick="calc();" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="Listo" >
    <label class="form-check-label" for="exampleRadios3">
        El equipo ha sido reparado
    </label>
  </div>
  <div class="form-check">
    <input onclick="calc();" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="otro" >
    <label class="form-check-label" for="exampleRadios4">
        otro
    </label>


  </div>
  <input placeholder="ingrese otro estatus" style="visibility: hidden" type="text" name="otrostatus" id="otrostatus" >






  <button type="submit">Actualizar</button>


  </form>


</body>
@vite("resources/js/updateequipo.js")
<script>
function calc()
{
  if (document.getElementById('exampleRadios4').checked)
  {
    document.getElementById('otrostatus').style.visibility="visible";

  }else{
    document.getElementById('otrostatus').style.visibility="hidden";
  }
}

</script>
</html>
