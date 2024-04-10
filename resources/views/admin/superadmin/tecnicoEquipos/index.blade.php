
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href={{ asset('css/admin/tecnico/style.css') }}>
    <title>Equipos atendidos por el tecnico</title>
</head>
<body>
    <nav class="navbar navcoloradmin">
        <a class="navbar-brand" href={{route("superadmin")}}>
          <img src={{asset("images/asitlogo.jpg")}} width="30" height="30" alt="">
        </a>
        <form class="form-inline">

            <button class="btn btn-light   my-2 my-sm-0" >
              <a href={{route("equipo")}}>Agregar equipo</a>
            </button>
          </form>
        <form class="form-inline"  action="{{ route('logoutA') }}" method="POST">
           @csrf
            <button class="btn botonsal   my-2 my-sm-0" type="submit">Salir</button>
          </form>

      </nav>
      <div class="form-group">
        <label for="sel1" style="color: white">Buscar por:</label>
        <select  class="form-control" name="selectsearch" id="optionsearch">
          <option value="1" >Por cliente</option>
          <option value="2">Por id</option>



        </select>
        <input type="search" id="searchinput" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
      </div>

      <div id="noresult">

        <a href={{route("mantenimientoTecnicoforspecific",["id"=>$admin])}} class="btn btn-primary">Ver todos los equipos</a>
        <a href={{route("mantenimientoTecnicoforspecific",["id"=>$admin,"finish"=>1,"all"=>0])}} class="btn btn-primary">Ver los equipos terminados</a>
        <a href={{route("mantenimientoTecnicoforspecific",["id"=>$admin,"finish"=>0,"all"=>1])}} class="btn btn-primary">Ver los equipos en proceso</a>
    </div>

      <div id="showsearch" class="row notshow">


      </div>


      <input id="iduser" class="notshow" type="text" value={{$admin}}>



      <div id="showall" class="row">

      @if (empty($mantenimientos[0]))
      <div id="noresult">
          <h1>No hay equipos</h1>
      </div>


    @else
        @foreach ($mantenimientos as $item)
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{$item->product->imagePrduct[0]->img->url_public}}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">ID:{{$item->foliId}}</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">Creado: {{date("Y-m-d",strtotime(date($item->created_at)))}}</h6>

                  <div class="row">
                    <p class="card-text">Estatus:{{$item->status}}</p>

                    @switch($item->status)
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
                    <li class="list-group-item">Cliente:{{$item->cliente->name}} {{$item->cliente->last_name}}
                        {{$item->cliente->mother_last_name}} </li>
                    <li class="list-group-item">Numero del cliente:{{$item->cliente->telefono}}</li>
                    <li class="list-group-item">Tecnico:{{$item->admin->name}}
                        {{$item->admin->last_name}} {{$item->admin->mother_last_name}}</li>
                    </li>
                  </ul>



                  <div class="card-body">
                    <a href={{route("chat",["id"=>$item->foliId])}}  class="btn btn-primary">Comentar</a>
                    <a href={{route("updateMantenimiento",["id"=>$item->foliId])}}  class="btn btn-primary">Actualizar</a>
                  </div>
                </div>
              </div>

        </div>

        @endforeach
        @endif

      </div>





      @if (empty($mantenimientos[0]))


      @else
      <div class="container">
        <div class="row">
            @if ($totalpages>1)
            @for ($i = 1; $i <= $totalpages; $i++)

         <div class="col-sm">

        <a class="btn btn-primary" href={{route("admin",["page"=>$i])}}>{{$i}}</a>


          </div>

            @endfor

            @endif

        </div>
      </div>

      @endif

   {{-- <script>
    const showall = document.getElementById("showall");

    const optionsearch = document.getElementById("optionsearch");
    const searchinput = document.getElementById("searchinput");
    let typeOfSearch="1"
    let searchsomething=""
    window.addEventListener("load",()=>{
        searchinput.addEventListener("input",async(e)=> {
            searchsomething= e.target.value
       if(searchsomething){
        showall.classList.add("notshow")
        switch (typeOfSearch) {
            case "1":
            const response = await fetch("/equiposearch",{
                method:"GET",
            });
  const movies = await response.json();
  console.log(movies);

                break;
            case "2":
                break;


            default:
                break;
        }
      }else{
        showall.classList.remove("notshow")
      }
        });
        optionsearch.addEventListener("change", updateValueOption);
        function updateValueOption(e) {
            typeOfSearch= e.target.value
            console.log(typeOfSearch)
        }






    })


   </script> --}}
   @vite('resources/js/searchsuperadmin.js')

   <script>

   </script>



</body>
</html>
