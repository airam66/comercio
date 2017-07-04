@extends('layouts.main')
 
 
@section('content')
<div class="box box-primary">

<div class="box-header ">
<h3 class="box-title">Fotos del Carrusel</h3>
</div>
<div class="box-body">  


<table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th style="width:10px">N° Imagen</th>
                <th>Imagen</th> 
                <th>Acción</th>
                   
            </tr>
        </thead>
     
       
<tbody>
   @foreach($imagenes as $imagen) 

        <tr role="row" class="odd">
        
            <td class="sorting_1">{{$imagen->id}}</td>
            <td> 
            @if($imagen->extension!=null)
                    <div>
                    <img src="{{ asset('images/carrusel/'.$imagen->extension)  }}" width="40" height="40" >
                    </div>
            @endif
            </td>

            <td>
                <a href="{{route('carrusel.edit',$imagen->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>
               
            </td>
           
           
        </tr>
      @endforeach
    </tbody>
    </table>
</div>
</div>


@endsection