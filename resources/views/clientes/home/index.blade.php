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
    <link rel="stylesheet" href="{{asset("css/cliente/style.css")}}">

</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24">
          </a>
          <form action="{{route("salircliente")}}" method="POST" class="d-flex">

            <button class="btn btn-outline-success" >Salir</button>
          </form>
        </div>
      </nav>

    <div class="d-flex d-flex justify-content-center vh-100">

        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{session("mantenimientocliente")->product->imagePrduct[0]->img->url_public}}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Numero orden:{{session("mantenimientocliente")->foliId}}</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">Creado: {{date("Y-m-d",strtotime(date(session("mantenimientocliente")->created_at)))}}</h6>

                  <div class="row">
                    <p class="card-text">Estatus:{{session("mantenimientocliente")->status}}</p>

                    @switch(session("mantenimientocliente")->status)
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
                  <ul class="list-group list-group-flush">

                    <li class="list-group-item">Tecnico:{{session("mantenimientocliente")->admin->name}}
                        {{session("mantenimientocliente")->admin->last_name}} {{session("mantenimientocliente")->admin->mother_last_name}}</li>
                    </li>
                  </ul>



                  <div class="card-body">
                    <a href="{{route("chatcliente",["id"=>session("mantenimientocliente")->foliId])}}"  class="btn btn-primary">Comentarios</a>

                  </div>
                </div>
              </div>

        </div>


    </div>

</body>
</html>
