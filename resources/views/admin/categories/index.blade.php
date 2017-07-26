@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h2 class="box-title col-md-5">Categorias Encontradas</h2>
    
                   
        
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
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('categories.create') }}'"/> 

</div>
<div class="box-body">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th style="width:10px">Codigo</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Imagen</th> 
                <th></th>
            </tr>
        </thead>
     
       
<tbody>
   @foreach($categories as $category) 

          @if ($category->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(255,96,96);">
          @endif
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>
            <td>{{$category->status}}</td>

            <td> 
            @if($category->extension!=null)
                   <div>
                   <img src="{{ asset('images/categories/'.$category->extension)  }}" width="40" height="40"> 
                   </div>
            @endif
            </td>
            <td>
            @if ($category->status!='inactivo')
             
                <a href="{{route('categories.edit',$category->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>

                     <a href="{{route('categories.desable',$category->id)}}" onclick="return confirm('¿Seguro dara de baja esta categoria?')">
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
            @else
                      <a href="{{route('categories.enable',$category->id)}}" onclick="return confirm('¿Seguro desea dar de alta esta categoría?')">
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
   {!!$categories->render()!!}
 </div>



</div>

</div>


@endsection