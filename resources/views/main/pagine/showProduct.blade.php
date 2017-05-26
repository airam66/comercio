@extends('layouts.app')
@section('content')

	<div class="container text-center">
		<div class="card product text-left">
			<h1> {{$product->name}} </h1>
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<img src="{{ asset('images/products/'.$product->extension)  }}" width="300" height="300">
				</div>
				<div class="col-sm-6 col-xs-12">
				<p style="text-align: center">
					<strong>Descripción</strong>

				</p>
				<p style="text-align: center">
					{{$product->description}}
				</p>
				</div>
			</div>
		</div>
	</div>
@endsection