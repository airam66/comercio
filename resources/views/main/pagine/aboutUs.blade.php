@extends('layouts.app')

@section('content')


    <div class="container space">
       <div class="row">
          <div class="col-md-8">
             <div class="panel panel-transparent ">
  
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