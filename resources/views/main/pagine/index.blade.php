@extends('layouts.my_template')

@section('content')

 <section class="home" id="home">
      <div class="content-wrap centering">
            <div class="mi_letter text-center">
              <h1>Bienvenido</h1>
              <img src="{{ asset('images/line.png')}}" alt=""> 
            </div> 
            <div>
              <!--inicio carrucel-->
         
      <div class="banner">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
@foreach($imagenes as $imagen)

      
    
    @if($imagen->id==1)
    <div class="item active">
      <img src="{{ asset('images/carrusel/'.$imagen->extension)  }}" alt="" class="">
      </div>
      @else
      <div class="item">
      <img src="{{ asset('images/carrusel/'.$imagen->extension)  }}" alt="" class="">

      </div>
    @endif
   
@endforeach
    
  </div>

  <!-- Controls 
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>-->
</div>
      </div>
     
      
  
            <!---->
              
              <div class="content-wrap">
                <div class="heading text-center">
                   <h1>Vení y lleva lo que más te guste.</h1>
                      <h3>Tenemos diversos productos personalizados.<br> 
                     Hace de tu fiesta un recuerdo inolvidable.</h3>

            </div>
            </div>
             <div class="text-center">
               <img src="{{ asset('images/line.png')}}" alt=""> 
             </div>
        
      </div>
    </section>

@endsection



