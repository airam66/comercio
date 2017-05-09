@extends('layouts.app')

@section('content')

 <div class="cover">
 <div class="content">


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
 
                </div>
            </div>
          </div>
 
</div>
</div>
</div>


</div>
</div>

@endsection