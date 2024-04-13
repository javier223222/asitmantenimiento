<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home cliente</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset("css/cliente/home/style.css")}}">

</head>
<body>
    <nav class="navbar navbar-estilo">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="/images/asit.png" alt="" width="90" height="50">
          </a>
          <h1 class="ttil">Seguimiento de equipo en mantenimiento</h1>
          <form action="{{route("salircliente")}}" method="POST" class="d-flex">

            <button class="btn btn-salir" >Salir</button>
          </form>
        </div>
      </nav>
    <div class="contenedor-carta">
    <div class="d-flex d-flex justify-content-center vh-100">

        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card" style="width: 18rem;">
                <div id="img">
                    <img id="imgexits" class="card-img-top" src="{{$mantenimiento->product->imagePrduct[0]->img->url_public}}" alt="Card image cap">

                </div>

                <div class="card-body">
                  <h5 class="card-title">Numero orden:{{$mantenimiento->foliId}}</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">Creado: {{date("Y-m-d",strtotime(date($mantenimiento->created_at)))}}</h6>
                <input type="text" id="folio" value="{{$mantenimiento->foliId}}" style="visibility: hidden">
                  <div id="showinitial" class="row">
                    <p class="card-text">Estatus:{{$mantenimiento->status}}</p>

                    @switch($mantenimiento->status)
                        @case("En fila")
                        <span class="material-symbols-outlined">
                            hourglass_empty
                            </span>

                            @break
                        @case("En mantenimiento")
                        <span class="material-symbols-outlined">
                            construction
                            </span>

                            @break
                        @case("Listo")
                        <span class="material-symbols-outlined">
                            done
                            </span>

                        @break


                        @default
                        <span class="material-symbols-outlined">
                            construction
                            </span>

                    @endswitch
                  </div>
                  <div style="visibility: hidden" class="row" id="showeventtype">

                  </div>
                  <ul class="list-group list-group-flush">

                    <li class="list-group-item">Tecnico:{{$mantenimiento->admin->name}}
                        {{$mantenimiento->admin->last_name}} {{$mantenimiento->admin->mother_last_name}}</li>
                    </li>
                  </ul>



                  <div class="card-body">
                    <a href="{{route("chatcliente",["id"=>$mantenimiento->foliId])}}"  class="btn btn-primary">Comentarios</a>

                  </div>
                </div>
              </div>

        </div>


    </div>
    </div>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @vite('resources/js/status.js')
    <script>


    </script>
</body>
</html>
