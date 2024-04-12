<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/cliente/style.css') }}" />
    <title>Buscar Equipo</title>
</head>
<body>
    <div class="contenedor">
    <div class="primero">
    <img src="/images/asit.png" alt="Logotipo" class="logotipo">  
    </div> 
    @if (session("errosearch"))
        <p style="color: red" class="msj-error">{{session("errosearch")}}</p>

    @endif

    <div class="segundo">
        <form action="{{route("buscarequipo")}}" method="post" class="formulario">
            @csrf
            <div>
            <h2>Asit</h2>
            <h2>Mantenimiento seguro</h2>
            <h1>EMPEZAR SEGUIMIENTO</h1>
            </div>
            <div class="co-1">
            <input placeholder="ingrese el folio" type="text" name="folio" id="serial" class="campo">
            </div>
           <div class="co-1">
           <input placeholder="ingrese el numero" type="text" name="numero" class="campo">
           </div>
            
            <button class="boton">Buscar</button>
        </form>

    </div>

    </div>
    

</body>
</html>
