@extends('layouts.my_template')

@section('content')
      <div class="mi_letter text-center">
                  <h3>Mi Carrito</h3>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>
@if ($shoppingcart->productsSize()>0)
    <div class="box-body">
          @include('main.pagine.shoppingcart.edit2') 

          {!! Form::open(['route'=>'orderOnline', 'method'=>'GET'])!!}
         
             <!-- FECHAS DEL PEDIDO--> 
                <div class="panel panel-primary" >
                   <div class="panel-body">
                      <div class="pull-left"> 
                          Entrega Pedido:
                          <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha" id="fecha1">
                      </div>
                   <div class="form-group">
                       {!! Form::submit('FINALIZAR COMPRA',['class'=>'btn btn-success col-xs-3 pull-right'])!!}
                   </div>
                   </div>
               </div>   
                    
      
            
          {!! Form::close() !!}
    </div>
@else
<div class="box-body">
<p>
Para cargar productos debe ingresar al <a href="{{route('catalogue')}}"><b>CATÁLOGO</b></a>
</p>

</div>

@endif



@endsection
@section('js')
@section('js')
<script>
  $('.input-daterange input').each(function() {
    $(this).datepicker({
         language: "es",
         autoclose: true,
         format:"yyyy/mm/dd"
    });
});

function deletefila(index,subTotal){
  console.log(index);
  TotalCompra= parseFloat($('#TotalCompra').val())-subTotal;
  console.log(subTotal);
  $('#TotalCompra').val(TotalCompra);
  $('#'+index).remove();
 }

</script>
@endsection