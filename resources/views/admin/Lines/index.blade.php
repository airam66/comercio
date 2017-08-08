@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h2 class="box-title col-md-5">Listado de Líneas</h2>
        
 
                   <!-- search name form -->
        <form route='admin.lines.index'  method="GET" class="col-md-3 col-md-offset-4 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('lines.create') }}'"/>

</div>
<div class="box-body">              
 @if($lines->isNotEmpty()) 
 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody>
   @foreach($lines as $line) 

          @if ($line->status!='inactivo')
            <tr role="row" class="odd">
                <td>{{$line->name}}</td>
                <td>{{$line->status}}</td>
                <td>
                <a href="{{route('lines.desable',$line->id)}}" onclick="return confirm('¿Seguro dará de baja esta línea?')">
                <button type="submit" class="btn btn-danger">
                  <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                </button>
                </a>

                  <a href="{{route('lines.edit',$line->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>
                </td>
              </tr>
          @endif
          
           
      
    @endforeach
      </tbody>
    </table>
  <div class="text-center">
    {!!$lines->render()!!}
  </div>

  @else
  <div class="alert alert-dismissable alert-warning">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <p>No se encontró ninguna línea.</p>
  </div>

  @endif



</div>

</div>


@endsection