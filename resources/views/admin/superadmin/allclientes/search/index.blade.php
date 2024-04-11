
@if (empty($clientes[0]))
<h1>no hay clientes</h1>
@else
<div  class="row">
@foreach ($clientes as $item)
<div class="col-sm-6 mb-3 mb-sm-0">
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Cliente</h5>

      <h6 class="card-subtitle mb-2 text-body-secondary">Nombre: {{$item->name}} {{$item->last_name}} {{$item->mother_last_name}}</h6>

      <p class="card-text">Numero de telefono: {{$item->telefono}}</p>
      <h6 class="card-subtitle mb-2 text-body-secondary">Creado: {{date("Y-m-d",strtotime(date($item->created_at)))}}</h6>


      <a href="{{route("allmantenimientosclientes",["id"=>$item->id_cliente])}}" class="btn btn-primary">Ver equipos en mantenimiento</a>
      <a href="#" class="btn btn-primary">Actualizar</a>





    </div>
  </div>
</div>
@endforeach


</div>

@endif


