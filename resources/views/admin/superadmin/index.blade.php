<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href={{ asset('css/admin/style.css') }}>
    <title>Super Admin</title>
</head>
<body>

    <nav style="background-color: #1F1F29" class="navbar bg-body-tertiary">
        <div style="background-color: #1F1F29" class="container">
            <form action="{{ route('logoutA') }}" method="POST">
                @csrf
                <button type="submit">Cerrar Sesion</button>
                </form>
        </div>
      </nav>



<div>
    <a href={{route("addTecnico")}} class="btn btn-primary">Agregar tecnico</a>

</div>

    @if (empty($admins[0]))
        <h1>no hay tecnicos</h1>
    @else
    <div class="row">
      @foreach ($admins as $item)
      <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Tenico</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Usuario: {{$item -> username}}</h6>
              <h6 class="card-subtitle mb-2 text-body-secondary">Nombre: {{$item->name}} {{$item->last_name}} {{$item->mother_last_name}}</h6>

              <p class="card-text">Contrasenia: {{$item->password_text}}</p>
              <h6 class="card-subtitle mb-2 text-body-secondary">Creado: {{date("Y-m-d",strtotime(date($item->created_at)))}}</h6>
              <form action={{route("deleteTecnico",["id"=>$item->id])}} method="POST">
                @csrf
                @method("DELETE")

                <button class="btn btn-danger">Eliminar<i class="bi bi-trash"></i></button>

              </form>


              <a href={{route("updateTecnico",["id"=>$item->id])}} class="btn btn-primary">Actualizar</a>

            </div>
          </div>
    </div>
      @endforeach

      </div>
</div>

    @endif




</body>
</html>
