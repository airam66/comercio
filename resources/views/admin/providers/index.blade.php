@extends('layouts.main')

@section('content')

<div class="box box-primary">

     <div class="box-header ">
        <h2 class="box-title col-md-5">Proveedores Encontrados</h2>    
        
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
        
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('providers.create') }}'"/> 

      </div>
     
     <div class="box-body">              

       <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
          <thead>
            <tr>
                <th style="width:10px">CUIT</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Localidad</th>
                <th>Provincia</th> 
                <th></th>
            </tr>
          </thead>
     
       
          <tbody>
             @foreach($providers as $provider) 

		          @if ($provider->status!='inactivo')
		            <tr role="row" class="odd">
		          @else
		            <tr role="row" class="odd" style="background-color: rgb(255,96,96);">
		          @endif
		            <td>{{$provider->cuit}}</td>
		            <td>{{$provider->name}}</td>
		            <td>{{$provider->address}}</td>
		            <td>{{$provider->location}}</td>
		            <td>{{$provider->province}}</td>
                    <td>
                      <button type="button" class="btn btn-primary "  data-title="Detail">
                         <i class="fa fa-list" aria-hidden="true"></i>
                      </button>

                    </td>
		           
                    </tr>
               @endforeach
             </tbody>
        </table>

    </div>

</div>


@endsection