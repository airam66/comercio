@extends('layouts.my_template')

@section('content')
<section id="contact" class="contact">
                     
  <div class="content-wrap centering">
       <div class="mi_letter text-center">
           <h1>Registrar Usuario</h1>
           <img src="{{ asset('images/line.png')}}" alt=""> 
           <br>
      </div> 

 <div class="row ">
     <div class="col-md-7 col-md-offset-3">
            
            {!! Form::open(['route'=>'webUser.store', 'method'=>'POST','files'=>true])!!}


              {!! Field::text('name')!!}

              <div >{!! Field::number('cuil')!!}</div>

                  <label> Localidad</label><br>
                   @include('location.location')
               {!! Field::text('address')!!}
              {!! Field::email('email')!!}
              {!! Field::number('phone')!!}
              {!! Field::file('photo')!!}

              {!! Field::password('password')!!}

              {!! Field::password('password_confirmation')!!}
              {!! Form::hidden('role_id',5)!!}

              
               
              
             
         
              <div class="form-group">
              {!! Form::submit('Registrar',['class'=>'btn btn-success'])!!}
              </div>
          
 
            {!! Form::close() !!}

         </div> </div>
<div class="text-center">
<img src="{{ asset('images/line.png')}}" alt=""> 
  
</div>
</div>

          

 </section>

          
        

@endsection

@section('js')
<script>
  $('.chosen-select').chosen();

</script>
@endsection