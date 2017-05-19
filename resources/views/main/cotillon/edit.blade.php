@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Datos de Cotillon</div>
                <div class="panel-body">

   {!! Form::open(['route'=>['cotillon.update','$cotillon'], 'method'=>'PUT'])!!}

   <div class="form-group">

      {!! Form::label('description_AboutUs','Descripcion')!!}
      {!! Form::textarea('description_AboutUs',$cotillon->description_AboutUs, ['class'=>'form-control'])!!}
   </div>

    <div class="form-group">

      {!! Form::label('address','Direccion')!!}
      {!! Form::text('address',$cotillon->address, ['class'=>'form-control'])!!}
   </div>

   <div class="form-group">

      {!! Form::label('phones','Telefono/s')!!}
      {!! Form::text('phones',$cotillon->phones, ['class'=>'form-control'])!!}

   </div>

   <div class="form-group">

      {!! Form::label('email','Email')!!}
      {!! Form::email('email',$cotillon->email, ['class'=>'form-control'])!!}
   </div>

    <div class="form-group">

      {!! Form::label('facebook','facebook')!!}
      {!! Form::text('facebook',$cotillon->facebook, ['class'=>'form-control'])!!}
   </div>

    <div class="form-group"> 

      {!! Form::label('business_hours','Horarios de Atencion')!!}
      {!! Form::text('business_hours',$cotillon->business_hours, ['class'=>'form-control'])!!}
   </div>

   <div class="form-group">
   {!! Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
   </div>
  
 
   {!! Form::close() !!}

     </div>
            </div>
        </div>
    </div>
</div>



@endsection