<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    </head>
    <body>
        <div>
            <h1>ASIT</h1>
            <h1>Mantenimiento Seguro</h1>
        </div>
        @if (session('error'))
            <div style="color: red">
                {{ session('error') }}
            </div>

        @endif
        <form action="{{ route('loginA') }}" method="POST">
            @csrf
            <label>Usuario</label>
            <input type="text" name="username" placeholder="ingrese su Usuario">
            <label>Password</label>
            <input type="password" name="password" placeholder="ingrese su password">
            <button type="submit">Entrar</button>
        </form>


    </body>


</html>
