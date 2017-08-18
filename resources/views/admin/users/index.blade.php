@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h2 class="box-title col-md-5">Listado de Usuarios</h2>
    
                   
        
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
       <!--Boton agregar usuario-->
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('users.create') }}'"/> 
 

</div>
<div class="box-body">              
  @if($users->isNotEmpty())
 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
               
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Foto</th> 
                <th></th>
            </tr>
        </thead>
     
       
<tbody>
   @foreach($users as $user) 

            <tr role="row" class="odd">
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td> 
            @if($user->name_photo!=null)
                   <div>
                  
                  <a data-toggle="modal" data-target="#favoritesModalUserImage{{$user->id}}">
                   <img src="{{ asset('images/users/'.$user->name_photo)  }}" width="40" height="40"> 
                   </a>
                   @include('admin.users.imagePopUp')
                   </div>
            @endif
            </td>
            <td>
              <a href="{{route('users.edit',$user->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>

            </td>
          
          
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

