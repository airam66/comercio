@extends('layouts.my_template')

@section('content')

 <section class="home" id="home">
      <div class="content-wrap centering">
            <div class="mi_letter text-center">
              <h1>Bienvenido</h1>
              <img src="{{ asset('images/line.png')}}" alt=""> 
            </div> 
            <div>
              <img src="{{asset('images/regalos.jpg')}}">
              
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



