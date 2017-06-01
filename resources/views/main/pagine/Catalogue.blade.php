@extends('layouts.app')

@section('content')

    
<div class="container space">
 <div class="row">
 <div class="col-md-3">
           @include('main.pagine.Catalogo.aside')
           
  </div>

  <div class="col-md-9">
    <div class="panel panel-transparent ">
      <div class="panel-body">    
        <div class="big-padingg text-center blue-grey white-text " > 
          <h2 class="borde">Productos</h2>
        </div>

        <div>
          @if(empty($products))
          <p>No hay datos para mostrar</p>
          @else
          @foreach($products as $product)
          <div class="card product mystyle"style="width: 190px;height: 270px;margin-right:10px; margin-bottom:8px;margin-left: 10px;">
	          <div>
	           @if($product->extension!=null)
             
              <img src="{{ asset('images/products/'.$product->extension)  }}"  width="160" height="150" >
            
             @endif
	         </div>
           <div >
	         <h4 class="text-center" style="height: 40px;">{{$product->name}}</h4>
           <div class="text-right" >
           <!--href="{{ route('catalogueShow.show', $product->id ) }}"-->
           <a  href="{{ route('catalogueShow.show', $product->id ) }}" >
	         <img src="{{ asset('images/informacion3.png ') }}" width="45" height="45"  > 
             </a>
             </div>
          </div>
          </div>
          @endforeach
          @endif
      
    
  </div>
       
       
      </div> {!! $products->render() !!}
      
    </div>
    
</div>
</div>
  </div>
 
 
@endsection