@extends('layouts.scrollingnav')
@section('content')

<table class="table table-condensed table-striped table-bordered">
  <thead>
    <tr class="bg-primary">
      <th scope="col" class="text-light">Imagen</th>
       <th scope="col" class="text-light">Nombre</th>
      <th scope="col" class="text-light">Puesto Actual</th>
      <th scope="col" class="text-light">Tiempo Laboral</th>
      <th scope="col" class="text-light">Perfil</th>
    </tr>
  </thead>
  @foreach ($puestos as $puesto)
  <tbody>
    @if(isset($puesto->imagen))
      <td><img src="profiles/{{$puesto->imagen}}" alt="" style="width:180px;"/></td>
    @else
    <td><img src="https://image.flaticon.com/icons/png/512/64/64572.png" alt="" style="width:180px;"/></td>
    @endif
  <td>{{$puesto->name}}</td>
  <td>{{$puesto->titulo}}</td>
  <td>{{$puesto->tiempo}}</td>
  <td> {!!link_to_route('user.show', $title = 'Mostar', $parameters = $puesto->id, $attributes = ['class'=>'btn btn-primary'])!!}</td>
  </tbody>
  @endforeach
</table>
{{ $puestos->links() }}
@stop