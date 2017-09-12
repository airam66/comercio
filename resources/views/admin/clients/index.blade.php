@extends('layouts.main')

@section('content')

<div class="box box-primary">

     <div class="box-header ">
        <h2 class="box-title col-md-5">Listado de Clientes</h2>    
        
        <!-- campo de busqueda-->
        <form route='admin.providers.index'  method="GET" class="col-md-3 col-md-offset-4 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- fin campo de busqueda -->
        
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('clients.create') }}'"/> 

      </div>
     
     <div class="box-body">   
      @if($clients->isNotEmpty())             

       <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
          <thead>
            <tr>
               
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Teléfono</th>
                <th>Saldo</th>
                
                <th></th>
            </tr>
          </thead>
     
       
          <tbody>
             @foreach($clients as $client) 

		          @if ($client->status!='inactivo')
		            <tr role="row" class="odd">
		          @else
		            <tr role="row" class="odd" style="background-color: rgb(255,96,96);">
		          @endif
		            
		            <td>{{$client->name}}</td>
		            <td>{{$client->address}}</td>
		            <td>{{$client->phone}}</td>
                <th>{{$client->bill}}</th>
		           
                <td>
                 @if ($client->status!='inactivo')
                   <a href="{{route('clients.edit',$client->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                    </a>  

                     <a href="{{route('clients.desable',$client->id)}}" onclick="return confirm('¿Seguro dará de baja este cliente?')">
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a> 
                  @else
                   <a href="{{route('clients.enable',$client->id)}}" onclick="return confirm('¿Seguro desea dar de alta este cliente?')">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                        </button>
                     </a>

                 @endif
                </td>
		           
                    </tr>
               @endforeach
             </tbody>
        </table>

         <div class="text-center">
        {!!$clients->render()!!}
      </div>

      @else
      <div class="alert alert-dismissable alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p>No se encontró ningún cliente.</p>
      </div>

      @endif

    </div>

</div>

@endsection