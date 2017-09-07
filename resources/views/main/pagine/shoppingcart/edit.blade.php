@extends('layouts.my_template')

@section('content')
      <div class="mi_letter text-center">
                  <h3>Mi Carrito</h3>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>
@if ($shoppingcart->productsSize()>0)
    <div class="box-body">
          {!! Form::open(['route'=>'orderOnline', 'method'=>'GET'])!!}
          <section>
          <div class="col-xs-12 table-responsive">
             <!-- FECHAS DEL PEDIDO--> 
                <div class="panel panel-primary" >
                   <div class="panel-body">
                      <div class="pull-left"> 
                          Entrega Pedido:
                          <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha" id="fecha1">
                      </div>
                  </div> 
               </div>   
           {!! Form::model($shoppingcart,['route'=>['shoppingcarts.update',$shoppingcart->id], 'method'=>'PATCH', 'files'=>true])!!} 

                    <table id="details" class="display table table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Producto</th>
                          <th>Precio Compra</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>

                      <tbody id="detail">
                      @php ($a = 0)
                      @foreach($details as $detail)
                      <tr class="selected" id={{$a}}>
                          <td><a href="{{route('shoppingcartsproducts.destroy',$detail->shopping_cart_id)}}" type="button" class="btn btn-danger" onclick="deletefila({{$a}},{{$detail->subTotal}});">X</a></td>
                        <td> 
                        <input readonly type="hidden" name="product_id[]" value="{{$detail->product_id}}">
                        <input readonly type="hidden" name="dproduct_id[]" value="{{$detail->shopping_cart_id}}">
                              @if($detail->extension!=null)
                                  <img src="{{asset('images/products/'.$detail->extension)}}" width="40" height="40" >
                              @endif {{$detail->product_name}}</td> 
                        <td>$ {{$detail->price}}</td> 
                        <td><input type="number" name="damount[]" value="{{$detail->amount}}"></td> 
                        <td>$ {{$detail->subTotal}}</td>
                       </tr>

                        @php ($a++) 
                       @endforeach  
                       </tbody>
                    </table>
              </div>
                       <div class="form-group col-md-offset-8 ">
                        <input type ='hidden' name='user_id' value="{{Auth::user()->id}}">
                        <input class="btn btn-success col-xs-5" type="submit" value="Actualizar Carrito">
                       </div>


                        <div class="row">
                            <div class="col-xs-6 pull-right">
                                <div class="text-center" style="background-color: gray;">
                                  <h3 style="color:white;">Total</h3>
                                </div>
                              <div class="table-responsive">
                                <table class="table">
                                  <tr>
                                    <th class="text-center">Total:</th>
                                    <td class="text-center">$<input disabled type="number" id="TotalCompra" name="TotalCompra" value="{{$shoppingcart->total}}" step="any" class="mi_factura"></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                        </div>
              <!-- /.content -->
              {!! Form::close() !!}              
              <div class="form-group">
              {!! Form::submit('FINALIZAR COMPRA',['class'=>'btn btn-success col-xs-3 pull-right', 'id'=>'confirm'])!!}
              </div>
            </section>
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