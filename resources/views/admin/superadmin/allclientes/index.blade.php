<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href={{ asset('css/admin/style.css') }}>
  <title>All clientes</title>
</head>

<body>
  <nav style="background-color: #1F1F29" class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand">
        <img src="/images/asitw.png" alt="ASIT" width="90" height="50">
      </a>
      <div class="d-flex gap-3">
        <button type="submit" class="btn btn_blue" style="margin">Regresar</button>
        </form>
      </div>
  </nav>

  <div>
    <input class="search-input my-2" placeholder="Ingrese el nombre del cliente" id="search" type="text">
  </div>
  <div style="visibility: hidden" id="showresults">

  </div>


  <div id="swoall" class="row">
    @if (empty($clientes[0]))
      <h1>no hay clientes</h1>
    @else
      <div class="container-fluid px-4 gy-3 text-justify">
        <div class="row gy-3">
          @foreach ($clientes as $item)
            <div class="col-6 col-md-6">
              <div class="card" style="width: 17vw;">
                <div class="card-body">
                  <h5 class="card-title">Cliente</h5>

                  <h6 class="card-subtitle mb-2 text-body-secondary">Nombre: {{ $item->name }} {{ $item->last_name }}
                    {{ $item->mother_last_name }}</h6>

                  <p class="card-text">Numero de telefono: {{ $item->telefono }}</p>
                  <h6 class="card-subtitle mb-2 text-body-secondary">Creado:
                    {{ date('Y-m-d', strtotime(date($item->created_at))) }}</h6>

                  <div class="row gy-1">
                    <div class="col">
                      <a href="{{ route('allmantenimientosclientes', ['id' => $item->id_cliente]) }}"
                        class="btn btn-primary">Ver
                        equipos en mantenimiento</a>
                    </div>

                    <div class="col">
                      <a href="#" class="btn btn-primary">Actualizar</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          @endforeach
        </div>
      </div>
  </div>


  @endif
  <div id="mostrarmapeo">
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

  </div>


  @vite('resources/js/searccliente.js')
  <script></script>

</body>

</html>
