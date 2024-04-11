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
  <nav style="background-color: #1F1F29" class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand">
        <img src="/images/asitw.png" alt="ASIT" width="90" height="50">
      </a>
      <div class="mx-auto">
        <h1 class="navbar-text title">Técnicos y equipos</h1>
      </div>
      <div class="d-flex gap-3">
        <div>
          <a href={{ route('addTecnico') }} class="btn btn-light">Agregar técnico</a>
        </div>
        <form action="{{ route('logoutA') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn_blue" style="margin">SALIR</button>
        </form>
      </div>
    </div>
  </nav>


  <form action={{ route('searchTecnico') }} method="POST" class="input-group">
    @csrf
    <div class="container-fluid px-4 text-justify">
      <div class="col-sm-2">
        <div class="input-group my-3">
          <input type="search" name="search" class="form-control" placeholder="Buscar técnico" aria-label="Search"
            aria-describedby="button-addon2">
          <button class="btn btn-outline-light">Buscar</button>
        </div>
      </div>
    </div>
  </form>




  @if ($isSearch)
    <div class="container-fluid px-4 text-justify">
      <div>
        <a href={{ route('superadmin') }} class="btn btn-outline-light">Ver a todos los tecnicos</a>

      </div>
    </div>
  @endif


  @if (empty($admins[0]))
    <div class="container-fluid px-4 text-justify">
      <h1 class="title">Técnico no encontrado</h1>
    </div>
  @else
    <div class="container-fluid px-4 text-justify">
      <div class="row gy-3">
        @foreach ($admins as $item)
          <div class="col-5 d-flex justify-content-start">
            <div class="card" style="width: 17vw">
              <div class="card-body">
                <h5 class="card-title">Técnico</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Usuario: {{ $item->username }}</h6>
                <h6 class="card-subtitle mb-2 text-body-secondary">Nombre: {{ $item->name }}
                  {{ $item->last_name }} {{ $item->mother_last_name }}</h6>

                <p class="card-text">Contraseña: {{ $item->password_text }}</p>
                <h6 class="card-subtitle mb-2 text-body-secondary">Creado:
                  {{ date('Y-m-d', strtotime(date($item->created_at))) }}</h6>

                <div class="row">
                  <div class="col">
                    <form action={{ route('deleteTecnico', ['id' => $item->id]) }} method="POST">
                      @csrf
                      @method('DELETE')

                      <button class="btn btn-danger">Eliminar <i class="bi bi-trash"></i></button>

                    </form>
                  </div>
                  <div class="col">
                    <a href={{ route('updateTecnico', ['id' => $item->id]) }} class="btn btn-primary">Actualizar</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        

      </div>
    </div>


  @endif

  @if (empty($admins[0]))
  @else
    <div class="container">
      <div class="row">

        @if ($totalpages > 1)

          @for ($i = 1; $i <= $totalpages; $i++)
            <div class="col-sm">

              <a href={{ route('superadmin', ['page' => $i]) }}>{{ $i }}</a>


            </div>
          @endfor

        @endif

      </div>

  @endif

  </div>


</body>

</html>
