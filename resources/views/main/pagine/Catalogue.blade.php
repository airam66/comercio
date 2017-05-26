@extends('layouts.app')

@section('content')
<div class="container space">
  <div class="col-md-13">
    <div class="panel panel-transparent ">
      <div class="panel-body">    
        <div class="big-padingg text-center blue-grey white-text" > 
          <h2>Productos</h2>
        </div>

        <div >
          @foreach($products as $product)
          <div style="background-color: white;  height: 250px;border-style: groove; margin:5px; float: left; width: 170px ; "  >
	          <div style="width: 160px; height: 160px; border-style: groove;">
	           @if($product->extension!=null)
              
              <img src="{{ asset('images/products/'.$product->extension)  }}" width="150" height="150" >
            
             @endif
	         </div>
	         <h4 style="text-align: center;">{{$product->name}}</h4>
           <a href="{{ route('catalogueShow.show', $product->id ) }}" >
	         <img src="images/informacion3.png " width="45" height="45" href="{{ route('catalogueShow.show',$product->id) }}" > 
             </a>
          </div>
          @endforeach
        </div>

      </div> {!! $products->render() !!}
    </div>
  </div>
</div>
   

@endsection