@extends('layouts.my_template')

@section('content')

 <section id="contact" class="contact">
                     
  <div class="content-wrap centering">
       <div class="mi_letter text-center">
           <h1>Contacto</h1>
           <img src="{{ asset('images/line.png')}}" alt=""> 
           <br>
      </div> 

  <div class="row">
     <div class="col-md-6 mi_letter text-center">

         
                <h3>Te invitamos a conocernos</h3>

                 
                   <h4><b>Direccion</b></h4>
                   <i class="glyphicon glyphicon-home"></i><h4>Roque Saenz Peña Nro 14 bis 2 B° San Martin</h4>

                   <h4><b>Telefonos</b></h4>
                    <i class="glyphicon glyphicon-earphone"></i><h4>  387 59662005 - 387 5910201</h4>

                   <h4><b>Email</b></h4>
                    <i class="glyphicon glyphicon-envelope"></i><h4>creatucotillon@gmail.com</h4>


                   <h4><b>Horarios de atencion</b></h4>
                
                    <i class="glyphicon glyphicon-time"></i> <h4> Lunes a Viernes: 9-13 / 17-21. Sabados: 9-13</h4>
                  
                    <h4><b>Redes sociales</b></h4>
                    <a  target="_blank" href="https://facebook.com/cotilloncreatu" class="btn btn-face"></a>
                    
                   <h4><b>Ubicación</b></h4>
                    

                 <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d1808.2491391175377!2d-65.58028314418695!3d-24.98317925224448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x941be3e7acffcfa7%3A0x77dee1db783bbb8!2sRoque+S%C3%A1enz+Pe%C3%B1a+14%2C+A4405ARA+Rosario+de+Lerma%2C+Salta!3m2!1d-24.983213!2d-65.5802506!5e0!3m2!1ses-419!2sar!4v1494973548168" width="520" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
     
 



    
      <div class="col-md-6 mi_letter">

                <div>
              <img src="{{asset('images/portada.jpg')}}">
               </div>
            
                 <h3>Enviános tu consulta</h3>

                @include('flash::message')

                {!! Form::open(['route' => 'send', 'method' => 'post']) !!}

            
                  <div class="form-group">

                      <h4>  {!! Form::label('name','Nombre (*)')!!}</h4>
                        {!! Form::text('name',null, ['class'=>'form-control','title'=>'El nombre es obligatorio','placeholder'=>'Ingrese un nombre..','required'])!!}
                  </div>
                 
                <div class="form-group">

                     <h4> {!! Form::label('email','Email (*)')!!}</h4>
                      {!! Form::email('email',null, ['class'=>'form-control','placeholder'=>'ejemplo@gmail.com','required'])!!}
                </div>
                 <div class="form-group">
                      <h4> {!! Form::label('subject','Asunto (*)')!!}</h4>
                      {!! Form::text('subject',null, ['class'=>'form-control','placeholder'=>'Ingrese un asunto','required'])!!}
                 </div>
                <div class="form-group">

                     <h4> {!! Form::label('body','Mensaje')!!}</h4>
                     {!! Form::textarea('body',null, ['class'=>'form-control'])!!}
                      
                </div>
                 <div class="form-group">
                     {!! Form::submit('Enviar',['class'=>'btn btn-success'])!!}
                 </div>

                {!! Form::close()!!}


   
                </div>
  
</div>
<div class="text-center">
<img src="{{ asset('images/line.png')}}" alt=""> 
  
</div>
</div>

          

        </section>
@endsection

