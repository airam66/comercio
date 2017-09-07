@extends('layouts.my_template')

@section('content')
<section>
                     
  <div class="content-wrap centering">
        <div class="mi_letter text-center">
                  <h3>Actualizar datos</h3>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>
         @include('flash::message')

    <div class="row">
      <div class="col-md-8">
        <div class="papers text-center">
          {!! Form::model(Auth::user(),['route'=>'webUsers.changeDatas', 'method'=>'PUT','files'=>true])!!}
              <div class="row ">
    
                  <div class="col-md-3">
      
                      <div class="card product photo_style">
                       <div>             
                          <img src="{{ asset('images/users/'.Auth::user()->photo_name)  }}"  width="160" height="150" >
                        </div>
                        <div>
                          {!! Field::file('photo')!!}
                        </div>

                      </div>
                   </div> 
              
            <div class="col-md-6">
               <h3>Información básica</h3>
               <hr> 
               
              
              {!! Field::text('name',$user->name)!!}
              {!! Field::number('cuil',$client->cuil)!!}  
              
               <h3>Información de contacto</h3>
               <hr>
              <label> Localidad</label><br>
              {!! Form::select('location',['Rosario de Lerma'=>'Rosario de Lerma','Salta'=>'Salta','San Lorenzo'=>'San Lorenzo','Cerrillos'=>'Cerrillos','Chicoana'=>'Chicoana','La Merced'=>'La Merced'],$client->location,['class'=>'form-control chosen-select'])!!} 
            
               {!! Field::text('address',$client->address)!!}
             
              {!! Field::number('phone',$client->phone)!!}
              
               {!! Field::email('email',Auth::user()->email,['disabled'])!!}
         
              <div class="form-group">
              {!! Form::submit('Guardar cambios',['class'=>'btn btn-success'])!!}
              </div>
          
               </div> 
        </div>
            {!! Form::close() !!}


        </div>
      </div>
      <div class="col-md-3">
        <div class="papers text-center">
         @include('main.pagine.webUsers.changePassword')
        </div>
      </div>
    </div>


            
            


   </div>
     <br>
     <div class="mi_letter text-center">
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>     

 </section> 
        

@endsection

@section('js')
<script>
  $('.chosen-select').chosen({
  no_results_text: 'No hay resultados'
});
</script>
@endsection