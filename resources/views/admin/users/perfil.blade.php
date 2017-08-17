@extends('layouts.main')


@section('content')

<div class="box box-widget widget-user-2">
	
	<div class="widget-user-header bg-aqua-active">
		
	  <div class="widget-user-image">
	   <img src="{{asset('dist/img/photo3.jpg')}}" class="img-circle" alt="User avatar">
	  </div>
	   <h3 class="widget-user-username"><b>{{ Auth::user()->name }}</b></h3>
	   <h4 class="widget-user-desc">Rol: {{ Auth::user()->role->name }}</h4>
	   <h4 class="widget-user-desc">Email: {{ Auth::user()->email }}</h4>
	   <h4 class="widget-user-desc">Usuario desde : {{ Auth::user()->created_at->format('d-m-Y') }}</h4>
	</div>
	<div class="box-footer">
		<div class="row">
			<div class="col-sm-4 border-right">
				<div class="description-block">
					
				<a href="{{ route('users.editPassword')}}">Cambiar Contraseña</a>
				</div>
			</div>
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<a href="{{route('users.edit',Auth::user()->id)}}"  >Modificar datos</a>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection