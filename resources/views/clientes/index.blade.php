<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/cliente/home/style.css') }}" />
    <title>Buscar Equipo</title>
</head>
<body>
    <div class="contenedor">
           <div class="primero">
            <img src="/images/asitw.png" alt="Logotipo" class="logotipo">  
            </div>   
     @if (session("errosearch"))
        <p style="color: red">{{session("errosearch")}}</p>

     @endif

            <div class="segundo">
            <form action="{{route("buscarequipo")}}" method="post" class="formu">
            @csrf
            <div>
              <h1>Asit</h1>
               <h1>Mantenimiento seguro</h1>
             </div>
             <div>
             <input placeholder="ingrese el folio" type="text" name="folio" id="serial" class="campo">
             </div>
             <div>
             <input placeholder="ingrese el numero" type="text" name="numero"  class="campo">
             </div>
            
            <button class="boton" >Buscar</button>
          </form>
            </div>

        </div>
</body>
</html>
