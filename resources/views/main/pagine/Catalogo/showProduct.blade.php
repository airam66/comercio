@extends('layouts.app')

@section('content')
<div class="container space">
 <div class="row">
 <div class="col-md-3">
        @include('main.pagine.Catalogo.aside')
           
  </div>
<!-- -->
  <div class="col-md-9 text-center">
	
	   
		<div class="card product text-left" >
		   
          
			<h1> {{$product->name}} </h1>
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<img src="{{ asset('images/products/'.$product->extension)  }}" width="300" height="300">
				</div>
				<div class="col-sm-6 col-xs-12 text-center">
				<p >
					<b>Descripción</b>

				</p>
				<p >
					{{$product->description}}
				</p>
				<p>
					<b>Marca: </b> {{$product->brand->name}}
				</p>
				</div>
			</div>
		</div>
     

     </div>
     </div>
     </div>

@endsection