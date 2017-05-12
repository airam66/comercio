@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">

   {!! Form::open(['route'=>'cotillon.store', 'method'=>'POST'])!!}

   <div class="form-group">

      {!! Form::label('name','Nombre')!!}
      {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Nombre del cotillon'])!!}
   </div>


   <div class="form-group">

      {!! Form::label('description_AboutUs','Descripcion')!!}
      {!! Form::textarea('description_AboutUs',null, ['class'=>'form-control'])!!}
   </div>

    <div class="form-group">

      {!! Form::label('address','Direccion')!!}
      {!! Form::text('address',null, ['class'=>'form-control'])!!}
   </div>

   <div class="form-group">

      {!! Form::label('phones','Telefono/s')!!}
      {!! Form::text('phones',null, ['class'=>'form-control'])!!}

   </div>

   <div class="form-group">

      {!! Form::label('email','Email')!!}
      {!! Form::email('email',null, ['class'=>'form-control'])!!}
   </div>

    <div class="form-group">

      {!! Form::label('facebook','facebook')!!}
      {!! Form::text('facebook',null, ['class'=>'form-control'])!!}
   </div>

    <div class="form-group"> 

      {!! Form::label('business_hours','Horarios de Atencion')!!}
      {!! Form::text('business_hours',null, ['class'=>'form-control'])!!}
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