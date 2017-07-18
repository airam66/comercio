@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h2 class="box-title col-md-5">Productos Encontrados</h2>
  
                   <!-- search name form -->
        <form route='admin.products.index'  method="GET" class="col-md-3 col-md-offset-1 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
            <!-- search event form -->
     
        <form  action="productsSearch" method="GET" class="col-md-3 col-md-offset-0 ">
            <div class="input-group">
              <input type="text" name="Evento" class="form-control" placeholder="Evento.."> 
              <span class="input-group-btn">
                <button  type="submit"  name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
        <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('products.create') }}'"/> 
          
       @if($validacion)
          <br>
          <br>
            <h5 class="alert alert-success col-md-0"  role="alert">No se encontro ningun producto </h5>
          @endif
</div>
<div class="box-body">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
             <th style="width:10px">Codigo</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Categoría</th>
               
                <th>Línea</th>
                <th>Estado</th>
                <th>Imagen</th> 
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody>
   @foreach($products as $product) 

          @if ($product->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(255,128,128);">
          @endif
            <td class="sorting_1">{{$product->code}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->category->name}}</td>   
            
            <td>{{$product->line->name}}</td>
            <td>{{$product->status}}</td>

            <td> 
            @if($product->extension!=null)
                    <div>
                    <img src="{{ asset('images/products/$product->extension')  }}" width="40" height="40" >
                    </div>
            @endif
            </td>

            <td>
            @if ($product->status!='inactivo')
             
                <a href="{{route('products.edit',$product->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>
                <a href="{{route('products.desable',$product->id)}}" onclick="return confirm('¿Seguro dara de baja el producto?')">
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
            @else

                <a href="{{route('products.enable',$product->id)}}" onclick="return confirm('¿Seguro dar de alta el producto?')">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                        </button>
                     </a>

            @endif
            </td>
            <td></td>
           
        </tr>
  @endforeach
</tbody>
    </table>
<div class="text-center">
  {!!$products->render()!!}
</div>


</div>

</div>


@endsection