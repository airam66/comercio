 {!! Form::model($shoppingcart,['route'=>['shoppingcarts.update',$shoppingcart->id], 'method'=>'PATCH', 'files'=>true])!!} 
 <section>
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
                <td  width="2%"><a href="{{route('shoppingcartsproducts.destroy',$detail->shopping_cart_id)}}" type="button" class="btn btn-danger" onclick="deletefila({{$a}},{{$detail->subTotal}});">X</a></td>
              <td> 
              <input readonly type="hidden" name="product_id[]" value="{{$detail->product_id}}">
              <input readonly type="hidden" name="dproduct_id[]" value="{{$detail->shopping_cart_id}}">
                    @if($detail->extension!=null)
                        <img src="{{asset('images/products/'.$detail->extension)}}" width="40" height="40" >
                    @endif {{$detail->product_name}}</td> 
              <td>$ {{$detail->price}}</td> 
              <td><input type="number" name="damount[]" value="{{$detail->amount}}" style="width:100px;"></td> 
              <td>${{$detail->subTotal}}</td>
             </tr>

              @php ($a++) 
             @endforeach  
             </tbody>
          </table>
    </div>
             
    <div class="form-group col-md-offset-8">
    {!! Form::submit('ACTUALIZAR CARRITO',['class'=>'btn btn-success'])!!}
    </div>

              <div class="row">
                  <div class="col-md-4 pull-right">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                      <thead>
                        <tr>
                        <th class="text-center">Total</th>
                        </tr>
                      </thead>
                        <tbody>
                        <tr>
                          <td class="text-right">$<input disabled type="number" id="TotalCompra" name="TotalCompra" value="{{$shoppingcart->total}}" step="any" class="mi_factura" class="mi_factura"></td>
                        </tr>
                        <tbody>
                      </table>
                    </div>
                  </div>
              </div>
</section>
    <!-- /.content -->
{!! Form::close() !!}       