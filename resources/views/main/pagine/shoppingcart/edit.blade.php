@extends('layouts.my_template')

@section('content')
      <div class="mi_letter text-center">
                  <h1>Tu Carrito</h1>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>
@if ($shopping_cart->productsSize()>0)
    <div class="box-body">
          {!! Form::model($shopping_cart,['route'=>['shoppingcarts.update',$shopping_cart->id], 'method'=>'PATCH', 'files'=>true])!!}
          <section>
              <!-- Table row -->
                  <div class="col-xs-12 table-responsive">
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
                          <td>
        <a href="{{route('shoppingcartsproducts.destroy',$detail->shopping_cart_id)}}" type="button" class="btn btn-danger" onclick="deletefila({{$a}},{{$detail->subTotal}});">X</a></td>
                      <td> 
                        <input readonly type="hidden" name="product_id[]" value="{{$detail->product_id}}">
                        <input readonly type="hidden" name="dproduct_id[]" value="{{$detail->shopping_cart_id}}">
                      @if($detail->extension!=null)
                          <img src="{{asset('images/products/'.$detail->extension)}}" width="40" height="40" >
                      @endif {{$detail->product_name}}</td> 
                        <td>{{$detail->price}}</td> 
                        <td><input type="number" name="damount[]" value="{{$detail->amount}}"></td> 
                        <td>{{$detail->subTotal}}</td>
                       </tr>

                        @php ($a++) 
                       @endforeach  
                       </tbody>
                    </table>
                  </div><!-- /.col -->
                       <div class="form-group ">
                        <input type ='hidden' name='user_id' value="{{Auth::user()->id}}">
                        {!! Form::submit('Actualizar Carrito',['class'=>'btn btn-primary'])!!}
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
                          <td class="text-center">$<input type="number" id="TotalCompra" name="TotalCompra" value="{{$shopping_cart->total}}" step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>
              </section><!-- /.content -->
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

<script>
function deletefila(index,subTotal){
  console.log(index);
  TotalCompra= parseFloat($('#TotalCompra').val())-subTotal;
  console.log(subTotal);
  $('#TotalCompra').val(TotalCompra);
  $('#'+index).remove();
 }
  

</script>
@endsection