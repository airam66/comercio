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


</div>
<div class="box-body">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
             <th style="width:10px">Codigo</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Eventos</th>
                <th>Línea</th>
                <th>Estado</th>
                <th>Imagen</th> 
                <th>Acción</th>
                   
            </tr>
        </thead>
 
        
       
<tbody>




   @foreach($products as $product) 

         <tr role="row" class="odd">
            <td class="sorting_1">{{$product->code}}</td>
            
           
            <td>{{$product->name}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->category->name}}</td>     
            <td></td>
            <td>{{$product->line->name}}</td>
            <td>{{$product->status}}</td>

            <td> 
            @if($product->extension!=null)
                    <div>
                    <img src="{{ asset('images/products/'.$product->extension)  }}" width="40" height="40" >
                    </div>
            @endif
            </td>

            <td> 
                <a href="{{route('products.edit',$product->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>
            </td>

            <td></td>
           
        </tr>
  @endforeach
</tbody>
    </table>



</div>

</div>


@endsection