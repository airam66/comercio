@extends('layouts.my_template')

@section('content')
      <div class="mi_letter text-center">
                  <h3>Mi Carrito</h3>
       <img src="{{ asset('images/line.png')}}" alt=""> 
      <br>
      Señor/a {{\Auth::user()->name}} Ud. pose 6 dia desde el dia de la fecha para acercarse a nuestrad direccion y confirmar su compra. Muchas Gracias.<br>
       					<div class="form-group">
                        <a href="{{route('my_order.pdf')}}" target="_blank" > 
                        <button  type="button" class="btn btn-primary "  ><i class="fa fa-print"></i>Imprimir comprobante PDF</button>
                        </a>
                       </div>
                       <br><br>
      </div>
@endsection