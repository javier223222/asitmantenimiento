<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    </head>
    <body>
        <div class="contenedor">
        <div class="primero">
        <img src="/images/asit.png" alt="Logotipo" class="logotipo"> 
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
            <h2>ASIT</h2>
            <h2>Mantenimiento Seguro</h2>
            <h1>ADMINISTRADOR</h1>
            </div>
            <div>
            <input type="text" name="username" placeholder="Usuario"  class="campo">
            </div>
            <div>
            <input type="password" name="password" placeholder="Password"  class="campo">
            </div>
            <button type="submit" class="boton">Entrar</button>
        </form>
    </div>


    </body>


</html>
