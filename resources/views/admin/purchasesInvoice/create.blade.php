@extends('layouts.main')

@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Registrar Factura de Compra</h3>
         </div>
      <div class="box-body">
          {!! Form::model($purchase,['route'=>['purchases.update',$purchase->id], 'method'=>'PATCH', 'files'=>true])!!}
          <section>
              <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
                     
                      <div class="pull-right">
                         <b>Orden de Compra N°:{{$purchase->id}}</b><br><br>
                         <b>Fecha: {{$purchase->created_at->format('d-m-Y')}}</b>
                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
              </div>
      
              <div class="border">
                <h3>Proveedor</h3>
                <div class="row ">
                         <div class="col-md-3 pull-left" >
                           
                           <h4><strong>Cuit: </strong> {{$purchase->provider->cuit}} </h4>
                           <input id="cuit"  class="form-control myfactura" value="{{$purchase->provider->cuit}}" type="hidden" >
                       </div>
                       
                      <div class="col-md-6  col-md-offset-2">
                            
                            <h4><strong>Nombre: </strong> {{$purchase->provider->name}}</h4>
                            <input id="provider_id" name="provider_id" class="form-control myfactura" value=" {{$purchase->provider->id}}" type="hidden" >
                            
                      </div>
                </div>
              </div>
              <hr>

              <div class="panel-body borde"><!--busqueda prorducto-->
                  <h3>Producto</h3>
                <div class="row " >
                    <div class="col-md-3 pull-left" >
                         {!! form::label('Codigo')!!}
                         <input id="code" class="form-control" name="code" type="text" >
                         <input id="product_id" class="form-control " name="product_id" type="hidden" >
                    </div> 
                    <div class="pull-left">
                    <br>
                       <button type="button" class="btn btn-primary pull-left" data-toggle="modal" id="first" data-title="Buscar" data-target="#favoritesModalProduct">
                          <i class="fa fa-search"></i>
                       </button>
                   </div>
                   
                   <div class="col-md-2 col-md-offset-2">
                       {!!Field::number('purchase_price',null, ['step'=>'any','disabled'])!!} 
 
                    </div>
                     <div class="col-md-2">
                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" 
                        onkeyup="">
                      </div>                    
                 </div>
                 <div class="row " >
                    <div class="col-md-4 pull-left ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                     
                    <div class="col-md-4  col-md-offset-1 ">
                         {!!Field::text('brand',null,['disabled'])!!}
                    </div>


                    <div class="col-md-2 col-md-offset-1">
                      <button type="button" id="btn_add" class="btn pull-right">
                      <img src="{{ asset('images/images.png ') }}" width="50" height="50">
                      </button>
                    </div>

                 </div>
              </div>
              <hr>

               <!-- Table row -->
                  <div class="col-xs-12 table-responsive">
                    <table id="details" class="display table table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Eliminar</th>
                          <th>Nombre</th>
                          <th>Marca</th>
                          <th>Precio Compra</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>

                      <tbody id="detail">
                      @php ($a = 0)
                      @php ($subTotal[$a]=0)
                      @foreach($details as $detail)
                      <tr class="selected" id={{$a}}>
                          <td><button type="button" class="btn btn-danger" onclick="deletefila({{$a}},{{$detail->subTotal}});">X</button></td>
                          <td> <input readonly type="hidden" name="dproduct_id[]" value="{{$detail->product_id}}">{{$detail->product_name}}</td> 

                          <td>{{$detail->brand_name}}</td> 

                          <td><input  type="number" name="dprice[]" id="dprice{{$a}}" value="{{$detail->price}} " onkeyup="calculateSubtotal({{$a}});"></td> 
                         <td><input  type="number" name="damount[]" id="damount{{$a}}" value="{{$detail->amount}}"onkeyup="calculateSubtotal({{$a}});"></td> 
                         <td><input id="dsubTotal{{$a}}" name="dsubtTotal" class="mi_factura" type="number" value="{{$detail->subTotal}}"></td>
                       </tr>
                          
                         
                        @php ($a++) 
                       @endforeach  
                      </tbody>

                    </table>
                  </div><!-- /.col -->


                  <div class="row">
                 
                  <div class="col-xs-6 pull-right">
                      <div class="text-center" style="background-color: gray;">
                        <h3 style="color:white;">Total</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th class="text-center">Total:</th>
                          <td class="text-center">$<input type="number" id="TotalCompra" name="TotalCompra" value="{{$purchase->total}}" step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>
        
              <div class="row no-print">
                  <div class="col-xs-12">
                        <div class="form-group">
                        {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
                       </div>
                  </div>
                </div>
              </section><!-- /.content -->
              {!! Form::close() !!}
             </div>
 
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>

 @include('partials.searchProductsPurchase')

@endsection

@section('js')

<script>

$('#searchP').on('click', function(){
  $value=$('#numberPurchase').val();  
  
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/completeOrder')}}",
    data:{'searchP':$value},
    success: function(data){
       
        $('#mostrar').html(data); 
        detailPurchase($value);

            
      }  
  })

})


function detailPurchase(value){
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/detailOrder')}}",
    data:{'searchP':value},
    success: function(data){
       
        $('#detail').html(data); 
        

            
      }  
  })


}
</script>

<script >
  function complete($id,$code,$brand,$name,$purchase,$stock){
    $('#code').val($code);
    $('#brand').val($brand);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#purchase_price').val($purchase);
    $('#favoritesModalProduct').modal('hide');
   $('#mostrar').html('');
  };
</script>

<script>
$('#searchProducts').on('keyup', function(){
  $value=$(this).val();

  $providerid=$('#provider_id').val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchProducts')}}",
    data:{'searchProducts':$value,'provider_id':$providerid},
    success: function(data){
     
      $('#mostrar').html(data);
    }
    
  })
})
</script>


<script>
    $('#btn_add').on('click',function(){
        invoice_detail();
    });

  var cont=2000;
  var TotalCompra=0;
  var Subtotal=[];

  function invoice_detail(){
    stock=$('#stock').val();
     brand=$('#brand').val();
     code=$('#code').val();
    product_id=$('#product_id').val();
    name=$('#name').val();
    price=$('#purchase_price').val();
    amount=$('#amount').val();
    
  if (product_id!="" && code!="" && name!="" && price!="" && amount>0){

      
         Subtotal[cont]=parseFloat(amount)*parseFloat(price);
         TotalCompra= parseFloat($('#TotalCompra').val())+Subtotal[cont];
         console.log(TotalCompra);

              var fila='<tr class="selected" id="'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+','+Subtotal[cont]+');">X</button></td><td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+name+'</td> <td>'+brand+'</td> <td><input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>'+Subtotal[cont]+'</td> </tr>';
          cont++;
          clear();
        $('#TotalCompra').val(TotalCompra);
        $('#details').append(fila);

     
  }else{
        alert("Error al ingresar detalle de la cotización, revise la cantidad del producto a vender");
  }
}

function deletefila(index,subTotal){
  console.log(index);
  TotalCompra= parseFloat($('#TotalCompra').val())-subTotal;
  console.log(subTotal);
  $('#TotalCompra').val(TotalCompra);
  $('#'+index).remove();
 }

 function clear(){
    $('#stock').val('');
    $('#code').val('');
    $('#product_id').val('');
    $('#name').val('');
    $('#price').val('');
    $('#priceR').val('');
    $('#priceW').val('');
    $('#wholesale_cant').val('');
    $('#amount').val('');
 }
</script>


<script>
  function productStockProvider(){
     $providerid=$('#provider_id').val();
                       $.ajax({
                        type: 'get',
                        url:  "{{ URL::to('admin/detailPurchase')}}",
                        data:{'provider_id':$providerid},
                        success: function(data){
                            $('#detail').html(data);
    
                        }
                       });
  }

</script>

<script >
  function complete($id,$code,$brand,$name,$purchase,$stock){
    $('#code').val($code);
    $('#brand').val($brand);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#purchase_price').val($purchase);
    $('#favoritesModalProduct').modal('hide');
   $('#mostrar').html('');
  };
</script>




<script>
    $('#btn_add').on('click',function(){
        invoice_detail();
    });

  var cont=2000;
  var TotalCompra=0;
  var Subtotal=[];

  function invoice_detail(){
    stock=$('#stock').val();
     brand=$('#brand').val();
     code=$('#code').val();
    product_id=$('#product_id').val();
    name=$('#name').val();
    price=$('#purchase_price').val();
    amount=$('#amount').val();
    
  if (product_id!="" && code!="" && name!="" && price!="" && amount>0){

      
         Subtotal[cont]=parseFloat(amount)*parseFloat(price);
         TotalCompra= parseFloat($('#TotalCompra').val())+Subtotal[cont];
         console.log(TotalCompra);

              var fila='<tr class="selected" id="'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+','+Subtotal[cont]+');">X</button></td><td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+name+'</td> <td>'+brand+'</td> <td><input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>'+Subtotal[cont]+'</td> </tr>';
          cont++;
          clear();
        $('#TotalCompra').val(TotalCompra);
        $('#details').append(fila);

     
  }else{
        alert("Error al ingresar detalle de la cotización, revise la cantidad del producto a vender");
  }
}

function deletefila(index,subTotal){
  console.log(index);
  TotalCompra= parseFloat($('#TotalCompra').val())-subTotal;
  console.log(subTotal);
  $('#TotalCompra').val(TotalCompra);
  $('#'+index).remove();
 }

 function clear(){
    $('#stock').val('');
    $('#code').val('');
    $('#product_id').val('');
    $('#name').val('');
    $('#price').val('');
    $('#priceR').val('');
    $('#priceW').val('');
    $('#wholesale_cant').val('');
    $('#amount').val('');
 }
</script>

<script>
  function calculateSubtotal(number){

     console.log(number);
    price= $('#dprice'+number).val();
    amount=$('#damount'+number).val();
    console.log(price);
    console.log(amount);
    $('#dsubTotal'+number).val(parseFloat(amount)*parseFloat(price));

  }

</script>

@endsection