@extends('layouts.app')

@section('content')


<div class="container space">
    <div class="row">
      <div class="col-md-6">
        
            <div class="panel panel-transparent">
               
                <div class="panel-body">
            
                <h2>Contacto</h2>

  
   @foreach($cotillones as $cotillon)

      <h4>Direccion</h4>
       {{$cotillon->address}}

     <h4>Telefonos</h4>
      {{$cotillon->phones}}

     <h4>Email</h4>
       {{$cotillon->email}}

      <h4>Horarios de atencion</h4>
  
       {{$cotillon->business_hours}}

    @endforeach

    <h4>Mapa</h4>

     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3616.4936392216555!2d-65.58252658499464!3d-24.98333698399607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3968e07f9c65ce87!2sLibrer%C3%ADa+del+Rosario!5e0!3m2!1ses-419!2sus!4v1493346864818" width="520" height="450" frameborder="0" style="border:0"></iframe>
     

            </div>
         </div>
      </div>
 
   <div class="col-md-6 col-md-offset-6">
     <div class="panel panel-transparent">
        <div class="panel-body">

        <h2>Enviénos su consulta</h2>

 {!! Form::open(['role'=>'form', 'method'=>'POST','action'=>'ContactUsController@contact'])!!}

   <div class="form-group">

    <h5>  {!! Form::label('name','Nombre (*)')!!}</h5>
      {!! Form::text('name',null, ['class'=>'form-control','title'=>'El nombre es obligatorio','placeholder'=>'Ingrese un nombre..','required'])!!}
   </div>


   <div class="form-group">

      <h5>{!! Form::label('phone','Telefono')!!}</h5>
      {!! Form::tel('phone',null, ['class'=>'form-control','placeholder'=>'387154987567 o 4253711'])!!}
   </div>

    <div class="form-group">

     <h5> {!! Form::label('email','Email (*)')!!}</h5>
      {!! Form::email('email',null, ['class'=>'form-control','placeholder'=>'ejemplo@gmail.com','required'])!!}
   </div>

    <div class="form-group">

     <h5> {!! Form::label('subject','Asunto (*)')!!}</h5>
      {!! Form::text('subject',null, ['class'=>'form-control','placeholder'=>'Ingrese un asunto','required'])!!}

   </div>

   <div class="form-group">

     <h5> {!! Form::label('message','Mensaje')!!}</h5>
     {!! Form::textarea('message',null, ['class'=>'form-control'])!!}
      
   </div>

   {!! Form::hidden('contact')!!}

   <div class="form-group">
   {!! Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
   </div>

 {!! Form::close()!!}


  </div>
  </div>
  </div>
 
</div>
</div>



@endsection