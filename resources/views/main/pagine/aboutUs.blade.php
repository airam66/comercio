@extends('layouts.app')

@section('content')


    <div class="container space">
       <div class="row">
          <div class="col-md-8">
             <div class="panel panel-transparent ">
  
                 <div class="panel-body">                  
     
                   <h2>Sobre Nosotros</h2>
                   @foreach($cotillones as $cotillon)
                  
                     @if(empty($cotillon->address))

                     <p>Sobre Nosotros.Sobre Nosotros.Sobre Nosotros.Sobre NosotrosSobre NosotrosSobre Nosotros
                     Sobre Nosotros.Sobre NosotrosSobre NosotrosSobre Nosotros.Sobre Nosotros.Sobre Nosotros
                     Sobre Nosotros.Sobre NosotrosSobre NosotrosSobre Nosotros.Sobre Nosotros.Sobre Nosotros</p>
                   
                     @else
                    
                   
                   
                     <p>{{$cotillon->description_AboutUs}}</p>
                     @endif

                   @endforeach
                   
                  
                 </div>
             </div>
           </div>
        </div>
    </div>


@endsection