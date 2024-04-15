@if (empty($mantenimientos[0]))
  <div class="title">
    <h1>No hay mantenimientos</h1>
  </div>
@else
  @foreach ($mantenimientos as $item)
    <div class="col-sm-6 mb-3 mb-sm-0">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ $item->product->imagePrduct[0]->img->url_public }}" alt="Card image cap">
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
            <a href="{{ route('chatcliente', ['id' => $item->foliId]) }}" class="btn btn-primary">Comentar</a>
            <a href={{ route('updateMantenimiento', ['id' => $item->foliId]) }} class="btn btn-primary">Actualizar</a>
          </div>
        </div>
      </div>

    </div>
  @endforeach

@endif
</div>
