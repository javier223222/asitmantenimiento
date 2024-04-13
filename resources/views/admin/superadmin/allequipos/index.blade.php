<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <link rel="stylesheet" href={{ asset('css/admin/tecnico/style.css') }}>
  <title>Equipos atendidos por el técnico</title>
</head>

<body>
  <nav style="background-color: #1F1F29" class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href={{ route('superadmin') }}>
        <img src="/images/asitw.png" alt="ASIT" width="90" height="50">
      </a>
      <div class="mx-auto">
        <h1 class="navbar-text title">Todos los equipos</h1>
      </div>
      <div class="d-flex gap-3">

        <div>
          <a href={{ route('addMantenimiento') }} class="btn btn-light">Agregar equipo</a>
        </div>

      </div>
    </div>
  </nav>

  <div class="input-group form-group input-group-md d-flex g-3 w-25 py-2 px-4">
    <label class="input-group-text" for="sel1" style="color: black">Buscar por:</label>
    <select class="form-control form-select" name="selectsearch" id="optionsearch">
      <option value="1">Por cliente</option>
      <option value="2">Por ID</option>
      <option value="3">Por técnico</option>


    </select>
    <input type="search" id="searchinput" name="search" class="form-control" placeholder="Search" aria-label="Search"
      aria-describedby="search-addon" />
  </div>

  <div id="noresult">
    <div class="d-flex gap-2 px-4 py-2 ">
      <a href={{ route('allEquiposMantenimiento') }} class="btn btn-light">Ver todos los equipos</a>
      <a href={{ route('allEquiposMantenimiento', ['finish' => 1, 'all' => 0]) }} class="btn btn-light">Ver los
        equipos
        terminados</a>
      <a href={{ route('allEquiposMantenimiento', ['finish' => 0, 'all' => 1]) }} class="btn btn-light">Ver los
        equipos en
        proceso</a>
    </div>
  </div>

  <div id="showsearch" class="row notshow">


  </div>






  <div id="showall" class="row">

    @if (empty($mantenimientos[0]))
      <div id="noresult">
        <div class="container-lg text-justify">
          <h1 class="title">No hay equipos</h1>
        </div>
      </div>
    @else
      <div class="container-fluid px-4 gy-3 text-justify">
        <div class="row gy-3">
          @foreach ($mantenimientos as $item)
            <div class="col-6 col-md-6">
              <div class="card" style="width: 17vw;">
                <img class="card-img-top w-auto h-auto" src="{{ $item->product->imagePrduct[0]->img->url_public }}"
                  alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">ID:{{ $item->foliId }}</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">Creado:
                    {{ date('Y-m-d', strtotime(date($item->created_at))) }}</h6>

                  <div class="row">
                    <p class="card-text">Estatus:{{ $item->status }}</p>

                    @switch($item->status)
                      @case('En fila')
                        <span class="material-symbols-outlined">
                          hourglass_empty
                        </span>
                      @break

                      @case('En mantenimiento')
                        <span class="material-symbols-outlined">
                          construction
                        </span>
                      @break

                      @case('Listo')
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
                    <li class="list-group-item">Cliente:{{ $item->cliente->name }} {{ $item->cliente->last_name }}
                      {{ $item->cliente->mother_last_name }} </li>
                    <li class="list-group-item">Numero del cliente:{{ $item->cliente->telefono }}</li>
                    <li class="list-group-item">Tecnico:{{ $item->admin->name }}
                      {{ $item->admin->last_name }} {{ $item->admin->mother_last_name }}</li>
                    </li>
                  </ul>



                  <div class="card-body">
                    <a href={{ route('chatcliente', ['id' => $item->foliId]) }} class="btn btn-primary">Comentar</a>
                    <a href={{ route('updateMantenimiento', ['id' => $item->foliId]) }}
                      class="btn btn-primary">Actualizar</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    @endif

  </div>





  @if (empty($mantenimientos[0]))
  @else
    <div class="container">
      <div class="row">
        @if ($totalpages > 1)
          @for ($i = 1; $i <= $totalpages; $i++)
            <div class="col-sm">

              <a class="btn btn-primary" href={{ route('admin', ['page' => $i]) }}>{{ $i }}</a>


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
  @vite('resources/js/searchall.js')

  <script></script>



</body>

</html>
