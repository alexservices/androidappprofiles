@extends('layouts.scrollingnav')
@section('content')

<table class="table table-condensed table-striped table-bordered">
  <thead>
    <tr class="bg-primary">
       <th scope="col" class="text-light">Nombre</th>
      <th scope="col" class="text-light">Puesto Actual</th>
      <th scope="col" class="text-light">Tiempo Laboral</th>
      <th scope="col" class="text-light">Perfil</th>
    </tr>
  </thead>
  @foreach ($puestos as $puesto)
  <tbody>
  <td>{{$puesto->name}}</td>
  <td>{{$puesto->titulo}}</td>
  <td>{{$puesto->tiempo}}</td>
  <td> {!!link_to_route('user.show', $title = 'Mostar', $parameters = $puesto->id, $attributes = ['class'=>'btn btn-primary'])!!}</td>
  </tbody>
  @endforeach
</table>
{{ $puestos->links() }}
@stop