@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h2 class="box-title col-md-5">Listado de Eventos</h2>
    
                   <!-- search name form -->
     
        <form route='admin.events.index'  method="GET" class="col-md-3 col-md-offset-4 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('events.create') }}'"/>

</div>
<div class="box-body">              
 @if($events->isNotEmpty()) 
 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody>
   @foreach($events as $event) 

          @if ($event->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(255,96,96);">
          @endif
            <td>{{$event->name}}</td>
            <td>{{$event->status}}</td>

            <td>
            @if ($event->status!='activo')
                   <a href="{{route('events.enable',$event->id)}}" onclick="return confirm('¿Seguro dar de alta este evento?')">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                        </button>
                     </a>
               
            @else
                    <a href="{{route('events.edit',$event->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>

                   <a href="{{route('events.desable',$event->id)}}" onclick="return confirm('¿Seguro dara de baja este evento?')">
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>


            @endif
            </td>
           
        </tr>
  @endforeach
   </tbody>
 </table>
<div class="text-center">
  {!!$events->render()!!}
</div>

@else
<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <p>No se encontró ningún evento.</p>
</div>

@endif

</div>

</div>


@endsection