@extends('layouts.app')

@section('content')



<div class="container space">

    <div class="row">
      <div class="col-md-6">
        
            <div class="panel panel-transparent">
               
                <div class="panel-body">
            
                <h2>Contacto</h2>

                 @foreach($cotillones as $cotillon)

                   @if(empty($cotillon->address))
                   <h4><b>Direccion</b></h4>
                    Roque Saenz Peña Nro 14 bis 2 B° San Martin

                   <h4><b>Telefonos</b></h4>
                    387 59662005 - 387 5910201

                   <h4><b>Email</b></h4>
                     cotilloncreatu@gmail.com

                   <h4><b>Facebook</b></h4>
                     <a href="https://facebook.com/cotilloncreatu">www.facebook.com/cotilloncreatu</a>

                   <h4><b>Horarios de atencion</b></h4>
                
                     Lunes a Viernes: 9-13 / 17-21. Sabados: 9-13
                   @else

                     <h4><b>Direccion</b></h4>
                       {{$cotillon->address}}

                     <h4><b>Telefonos</b></h4>
                      {{$cotillon->phones}}

                     <h4><b>Facebook</b></h4>
                     <a href="https://facebook.com/cotilloncreatu">{{$cotillon->facebook}}</a>

                     <h4><b>Email</b></h4>
                       {{$cotillon->email}}

                      <h4><b>Horarios de atencion</b></h4>
                  
                       {{$cotillon->business_hours}}
                     @endif

                    @endforeach
                              
                <h4><b>Mapa</b></h4>

                 <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d1808.2491391175377!2d-65.58028314418695!3d-24.98317925224448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x941be3e7acffcfa7%3A0x77dee1db783bbb8!2sRoque+S%C3%A1enz+Pe%C3%B1a+14%2C+A4405ARA+Rosario+de+Lerma%2C+Salta!3m2!1d-24.983213!2d-65.5802506!5e0!3m2!1ses-419!2sar!4v1494973548168" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
            </div>
        </div>
 



    
      <div class="col-md-6 col-md-offset-6">
        
            <div class="panel panel-transparent">
               
                <div class="panel-body">


            
                <h2>Enviénos su consulta</h2>

                @include('flash::message')

                {!! Form::open(['route' => 'send', 'method' => 'post']) !!}

            
                  <div class="form-group">

                      <h5>  {!! Form::label('name','Nombre (*)')!!}</h5>
                        {!! Form::text('name',null, ['class'=>'form-control','title'=>'El nombre es obligatorio','placeholder'=>'Ingrese un nombre..','required'])!!}
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

                     <h5> {!! Form::label('body','Mensaje')!!}</h5>
                     {!! Form::textarea('body',null, ['class'=>'form-control'])!!}
                      
                </div>
                 <div class="form-group">
                     {!! Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
                 </div>

                {!! Form::close()!!}


   
                </div>
              </div>
            </div>
 
          </div>
        </div>
     </div>
   </div>
</div>




@endsection