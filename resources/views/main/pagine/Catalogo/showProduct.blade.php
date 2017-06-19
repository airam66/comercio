@extends('layouts.my_template')

@section('content')

 <div class="content-wrap centering">
	   
		<div class="card product-show text-left" >
		   
          
			<h1> {{$product->name}} </h1>
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<img src="{{ asset('images/products/'.$product->extension)  }}" width="300" height="300">
				</div>
				<div class="col-sm-6 col-xs-12 text-center">
				<p >
					<strong>Descripción</strong>

				</p>
				<p >
					{{$product->description}}
				</p>
				</div>
			</div>
		</div>
     </div>
@endsection