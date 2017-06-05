@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header">
                  <h3 class="box-title">Productos Encontrados</h3>
                </div>

<div class="box-body">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
             <th style="width:10px">Codigo</th>
                <th>Nombre</th>
                <th>Categoria</th>
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
            <td>{{$product->category->name}}</td>
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