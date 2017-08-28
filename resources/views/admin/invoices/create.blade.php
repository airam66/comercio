@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nueva Venta</h3>
         </div>
      <div class="box-body">
          {!! Form::open(['route'=>'invoices.store', 'method'=>'POST', 'files'=>true])!!}
          <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
                     
                      <div class="pull-right">
                         <b>Venta N°:{{$numberinvoice}}</b><br><br>
                         <b>Fecha: {{$date}}</b>
                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
                </div>
                <!-- info row -->
      <div class="panel panel-default">
          <div class="panel-body borde"><!--busqueda producto-->
             <div class="border">
                <h3>Cliente</h3>
                <div class="row ">
                       @include('partials.searchPeople')
                      <div class="col-md-3 pull-left" >
                           {!! form::label('CUIL/CUIT')!!}
                           <input id="cuil" class="form-control" name="cuil" type="text" >
                       </div>
                       <div class="pull-left">
                       <br>
                            <button type="button" class="btn btn-primary " data-toggle="modal" id="second" data-title="Buscar" data-target="#favoritesModalClient"><i class="fa fa-search"></i></button>
                           @include('partials.searchPeople')
                      </div>
                      <div class="col-md-6  pull-right">
                            <input id="client_id" name="client_id" class="form-control" type="hidden" >
                            {!!Field::text('nombre',null,['disabled'])!!}
                      </div>
               </div>
            </div>
                
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
                   <div class="col-md-2 pull-right ">
                       {!!Field::number('price',null, ['disabled'])!!} 
                       <input type="number" id="priceW" name="priceW" style="display:none"> 
                       <input type="number" id="priceR" name="priceR" style="display:none"> 
                    </div>
                    <div class="col-md-2 pull-right ">
                          {!! Field::number('stock' , ['disabled'])!!}
                    </div>
                     <div class="col-md-2 pull-right">
                        <input type="number"  id="wholesale_cant" name="wholesale_cant" style="display:none"> 

                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" >
                        </div>
                    
                 </div>

                <div class="row ">
                    <div class="col-md-6 pull-left ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>

                    <div class="col-md-4 col-md-offset-2">
                      <button type="button" id="btn_add" class="btn pull-right">
                      <img src="{{ asset('images/images.png ') }}" width="50" height="50">
                      </button>
                    </div>

                </div>
                
<!--find busqueda de producto-->
        </div>
                <!-- Table row -->
                  <div class="col-xs-12 table-responsive">
                    <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <tr>
                          <th>Eliminar</th>
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>

                      <tbody>
                         
                      </tbody>

                    </table>
                  </div><!-- /.col -->
               

                <div class="row">
            
                  <div class="col-xs-6">
                  </div>
                  <div class="col-xs-6">
                      <div class="text-center" style="background-color: gray;">
                        <h3 style="color:white;">Total</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$<input disabled type="number" id="Subtotalventa" name="Subtotalventa" step="any" class="mi_factura"></td>
                        </tr>
                        <tr>
                          <th>Descuento</th>
                          <td><div class="checkbox">
                                  <label>
                                      <input id="discount" name="discount" type="checkbox" value="10">
                                      10%
                                  </label>
                              </div></td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>$<input type="number" id="Totalventa" name="Totalventa" step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">
                      <div class= "form-group">
                      {!! Form::hidden('status','activo',['class'=>'form-control'])!!} 
                      </div>

                      <div class="form-group">
                        {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
                       </div>
                  </div>
                </div>
              </section><!-- /.content -->

             </div>
 
              {!! Form::close() !!}

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>

@include('partials.searchProductsInvoice')


@endsection

@section('js')

<script type="text/javascript">
 var options={
    url: function(q){
      return baseUrl('admin/autocomplete?q='+q);
         }, getValue:"code",
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var product = $("#code").getSelectedItemData();
                          $('#stock').val(product.stock);
                          $('#product_id').val(product.id);
                          $('#name').val(product.name);
                          $('#price').val(product.retail_price);//por defecto
                          $('#priceR').val(product.retail_price);
                          $('#priceW').val(product.wholesale_price);
                          $('#amount').val(0);
                          $('#wholesale_cant').val(product.wholesale_cant);
                    },
                    onKeyEnterEvent: function () { 
                        var product = $("#code").getSelectedItemData();
                          $('#stock').val(product.stock);
                          $('#product_id').val(product.id);
                          $('#name').val(product.name);
                          $('#price').val(product.retail_price);//por defecto
                          $('#priceR').val(product.retail_price);
                          $('#priceW').val(product.wholesale_price);
                          $('#amount').val(0);
                          $('#wholesale_cant').val(product.wholesale_cant);
                    }
                }
   };
  
  $("#code").easyAutocomplete(options);
</script>

<script type="text/javascript">
  function complete($id,$code,$name,$wholesale,$retail,$stock,$amount){
    var am=0;
    $('#stock').val($stock);
     $('#code').val($code);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#price').val($retail);//por defecto
    $('#priceR').val($retail);
    $('#priceW').val($wholesale);
    $('#wholesale_cant').val($amount);
    $('#amount').val(am);
    $('#favoritesModalProduct').modal('hide');
  };
</script>


<script type="text/javascript">

$('#favoritesModalClient').on('shown.bs.modal', function () {
  $('#searchC').focus()
})

function productStockProvider(){
}


</script>
<script>



$('#amount').on('keyup', function(){
  var am=parseInt($('#amount').val());
  var maxW=parseInt($('#wholesale_cant').val());
  var pW=$('#priceW').val();
  var pR=$('#priceR').val();
   if (am >= maxW){
    console.log('mayor a la cantidad');
        $('#price').val(pW);
  }
  else{
    console.log('menor a la cantidad');
        $('#price').val(pR);
  }
});
</script>

<script>
$('#discount').on('click', function(){
  St=$('#Subtotalventa').val();
  Tvo=$('#Totalventa').val();
    if(St==Tvo){
      Tvn=parseFloat(St)-parseFloat(St*0.1);
        $('#Totalventa').val(Tvn); 
     }else{
        $('#Totalventa').val(St);
     }
})
</script>

<script>
$('#search').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/search')}}",
    data:{'search':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
})
</script>

<script type="text/javascript">
$('#searchC').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchClient')}}",
    data:{'searchClient':$value},
    success: function(data){
      $('#mostrarC').html(data);
    }
    
  })
})

</script>

<script>
    $('#btn_add').on('click',function(){
        invoice_detail();
    });

  var cont=0;
  var Totalventa=0;
  var Subtotal=[];

  function invoice_detail(){
    stock=$('#stock').val();
    code=$('#code').val();
    product_id=$('#product_id').val();
    name=$('#name').val();
    price=$('#price').val();
    amount=$('#amount').val();
    
  if (product_id!="" && code!="" && name!="" && price!="" && amount>0){

      if (parseInt(amount)<parseInt(stock)){
         Subtotal[cont]=parseFloat(amount)*parseFloat(price);
         Subtotal[cont]=Math.round(Subtotal[cont]*100)/100;
         Totalventa=Totalventa+Subtotal[cont];

              var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+');">X</button></td> <td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+code+'</td> <td>'+name+'</td> <td>$<input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>$'+Subtotal[cont]+'</td> </tr>';
          cont++;
          clear();
        $('#Subtotalventa').val(Totalventa);
        $('#Totalventa').val(Totalventa); 
        $('#details').append(fila);

      }else{
          alert ('La cantidad a vender supera el stock');
      }

  }else{
        alert("Error al ingresar detalle de la cotización, revise la cantidad del producto a vender");
  }
}

function deletefila(index){
  Totalventa=Totalventa-Subtotal[index];
  $('#Subtotalventa').val(Totalventa);
  $('#Totalventa').val(Totalventa);
  $('#fila'+index).remove();
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
  function SearchLetter($letter){
  $value=$letter;
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchL')}}",
    data:{'searchL':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  });
  }
</script>
 


@endsection
 

@push('scripts')

<script src="{{asset('dist/js/completePerson.js')}}"></script>
@endpush