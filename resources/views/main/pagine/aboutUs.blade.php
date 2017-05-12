@extends('layouts.app')

@section('content')


       <div class="cover">
           <div class="content">


<div class="panel panel-primary panel-transparent ">
<div class="col-md-6">
  
  <div class="panel-body">                  
     
      <h2>Sobre Nosotros</h2>
     @foreach($cotillones as $cotillon)

  
   <h4> {{$cotillon->description_AboutUs}}</h4>

    @endforeach
  </div>
</div>
</div>

</div>
</div>

@endsection