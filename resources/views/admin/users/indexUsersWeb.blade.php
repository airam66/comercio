@extends('layouts.main')

@section('content')

<div class="box box-primary">
  <div class="box-header ">
    <h2 class="box-title col-md-5">Listado de Usuarios de la Página Web</h2>
      
        <!-- search name form -->
        <form route='admin.categories.index'  method="GET" class="col-md-3 col-md-offset-4 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
      <!-- /.search form -->

  </div>
  <div class="box-body">              
       @if($users->isNotEmpty())
       <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
          <thead>
            <tr>
               
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th> 
                <th>Localidad</th>
            </tr>
          </thead>
     
       
          <tbody>
             @foreach($users as $user) 

                <tr role="row" class="odd">
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->location}}</td>
                </tr>
            @endforeach
          </tbody>
      </table>
       <div class="text-center">
         {!!$users->render()!!}
       </div>

     @else
      <div class="alert alert-dismissable alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p>No se encontró ningun usuario.</p>
      </div>

     @endif

  </div>
</div>


@endsection

