<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    </head>
    <body>
    <div class="contenedor">
            <div class="primero">
            <img src="/images/asitw.png" alt="Logotipo" class="logotipo">  
            </div>    

        @if (session('error'))
            <div style="color: red">
                {{ session('error') }}
            </div>

        @endif
        <div class="segundo">
        <form action="{{ route('loginA') }}" method="POST" class="formulario">
            @csrf
            <div>
            <h1>ASIT</h1>
            <h1>Mantenimiento Seguro</h1>
            </div>
            <div>
            <input type="text" name="username" placeholder="ingrese su Usuario" class="campo">
            </div>
           
           <div>
           <input type="password" name="password" placeholder="ingrese su password" class="campo">
           </div>
            <button type="submit" class="boton">Entrar</button>
        </form>
        </div>
       </div>
    </body>


</html>
