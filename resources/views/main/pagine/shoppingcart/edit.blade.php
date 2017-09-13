@extends('layouts.my_template')

@section('content')
 <div class="content-wrap centering">
      <div class="mi_letter text-center">
                  <h3>Mi Carrito</h3>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>
@if ($shoppingcart->productsSize()>0)
    <div class="box-body">
          @include('main.pagine.shoppingcart.edit2') 

          {!! Form::open(['route'=>'orderOnline', 'method'=>'GET'])!!}
         
             <!-- FECHAS DEL PEDIDO--> 
             <div class="row">
               <div class="col-md-4 pull-right">
                <div class="panel panel-primary" >
                   <div class="panel-body">
                     
                    
                          Entrega Pedido:
                          <div class="form-group{{ $errors->has('datepicker') ? ' has-error' : '' }}">
                            <div class="form-group">
                                  <div class='input-group date' >
                                      <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="Seleccione una fecha" value="{{ old('datepicker') }}">
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                      </span>
                                  </div>
                              </div>
                            @if ($errors->has('datepicker'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('datepicker') }}</strong>
                                    </span>
                          @endif
                        </div>
                         
                           {!! Form::submit('FINALIZAR COMPRA',['class'=>'btn btn-success'])!!}
                      </div>                                         
                 
                  </div>
                  
                </div>
                
              </div>
    
            
          {!! Form::close() !!}
    </div>
@else
<div class="box-body">
<p class="text-center">
Para cargar productos debe ingresar al <a href="{{route('catalogue')}}"><b>CATÁLOGO</b></a>
</p>

</div>

@endif

<div class="mi_letter text-center">
     <img src="{{ asset('images/line.png')}}" alt=""> 
</div> 
</div>


@endsection
@section('js')
@section('js')
<script>
  $('#datepicker').each(function() {
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