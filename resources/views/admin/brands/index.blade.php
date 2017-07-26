@extends('layouts.main')

@section('content')

<div class="box box-primary">

  <div class="box-header ">
    <h2 class="box-title col-md-5">Marcas encontradas</h2>
      
      <!-- form busqueda -->
        <form route='admin.brands.index'  method="GET" class="col-md-3 col-md-offset-4 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /form  busqueda-->
        
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('brands.create') }}'"/> 

  </div>
  <!--Inicio body-->
  <div class="box-body">              

    <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
              
                <th>Nombre</th>
               <th>Estado</th>
               <th></th>
               
            </tr>
        </thead>
     
       
        <tbody>
           @foreach($brands as $brand) 

                  
                    <tr role="row" class="odd">

                      <td>{{$brand->id}}</td>

                      <td>{{$brand->name}}</td>
                      <td>{{$brand->status}}</td>
                      <td> 
                      
                      <a href="{{route('brands.edit',$brand->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>


                      <a href="{{route('brands.desable',$brand->id)}}" onclick="return confirm('¿Seguro dara de baja esta marca?')">
                          <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                          </button>
                      </a>
                      </td>
                    </tr>
          @endforeach
        </tbody>
    </table>
    <div class="text-center">
      {!!$brands->render()!!}
    </div>
  </div><!--Fin body-->
</div>

@endsection