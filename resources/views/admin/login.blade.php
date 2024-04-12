<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" />
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
            <div class="co-1">
            <input type="text" name="username" class="campo" placeholder="Usuario:">
            </div>
            <div class="co-1">
            <input type="password" name="password" class="campo" placeholder="Contraseña:">
            </div>  
            <button type="submit" class="boton">Entrar</button>
        </form> 
        </div> 
        </div>
    </body>


</html>
