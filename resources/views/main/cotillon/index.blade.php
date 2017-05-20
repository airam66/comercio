@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Datos de Cotillon</div>
                <div class="panel-body">
 <table class="table table-striped">

  <thead>
    
    <th>Nombre</th>
    <th>Direccion</th>
    <th>Email</th>
    <th>Telefonos</th>
    <th>Accion</th>

  </thead>

  <tbody>

   @foreach($cotillones as $cotillon)

   <tr>
   <td> {{ $cotillon->name}}</td>
   <td> {{ $cotillon->address}}</td>
   <td> {{ $cotillon->email}}</td>
   <td> {{ $cotillon->phones}}</td>

   <td><a href="{{ route('cotillon.edit',$cotillon->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
   </td>
   </tr>

  @endforeach

  </tbody>

</table>

<div class="text-center">

  {!! $cotillones->links()!!}

</div>

</div>
</div>
</div>
</div>
</div>
@endsection