@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nueva Venta</h3>
          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
           
         </div>
          <div class="box-body">
          {!! Form::open(['route'=>'invoices.store', 'method'=>'POST', 'files'=>true])!!}
          <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="150" height="80"  >
                     
                      <div class="pull-right">
                         <b>Venta N°: #########</b><br><br>
                         <b>Fecha: {{$date}}</b>
                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
                </div>
                <!-- info row -->
      <div class="panel panel-default">
          <div class="panel-body borde"><!--busqueda prorducto-->
                <div class="row invoice-info" >
                    <div class="col-md-3" >
                         {!! form::label('Codigo')!!}
                         <input id="code" class="form-control" name="code" type="text" >
                         <input id="product_id" class="form-control " name="product_id" type="hidden" >
                    </div> 

                    <div class="col-md-1 col-md-offset-0" >
                      <br>
                       <button type="button" class="btn btn-primary" data-toggle="modal" data-id="" data-title="Buscar" data-target="#favoritesModal">
                          <i class="fa fa-search"></i>
                       </button>
                    </div>
                   
                    <div class="col-md-4 col-md-offset-2">
                       {!!Field::number('price',null, ['disabled','step'=>'any'])!!} 
                       {!!Field::hidden('priceW',null,['step'=>'any'])!!} 
                       {!!Field::hidden('priceR',null,['step'=>'any'])!!} 
                    </div>
                 </div>

                <div class="row invoice-info">
                    <div class="col-md-6">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                    <div class="col-md-4">
                          {!! Field::number('stock' , ['disabled'])!!}
                    </div>
                </div>

                <div class="row invoice-info">

                    <div class="col-md-4">
                        {!!Field::hidden('wholesale_cant',null)!!}
                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" 
                        onkeyup="price_select(this.value,this.form.wholesale_cant.value)">
                        </div>

                    <div class="col-md-4 col-md-offset-2">
                      <img src="{{ asset('images/images.png ') }}" width="50" height="50" class="pull-right"  >
                         
                    </div>
                </div>
      </div>
</div>
<!--find busqueda de producto-->
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>000111</td>
                          <td>centro de mesa</td>
                          <td>10</td>
                          <td>5</td>
                          <td>50</td>
                        </tr>
                        <tr>
                          <td>000111</td>
                          <td>centro de mesa</td>
                          <td>10</td>
                          <td>5</td>
                          <td>50</td>
                        </tr>
                        <tr>
                          <td>000111</td>
                          <td>centro de mesa</td>
                          <td>10</td>
                          <td>5</td>
                          <td>50</td>
                        </tr>
                          <tr>
                          <td>000111</td>
                          <td>centro de mesa</td>
                          <td>10</td>
                          <td>5</td>
                          <td>50</td>
                        </tr>
                        <tr>
                          <td>000111</td>
                          <td>centro de mesa</td>
                          <td>10</td>
                          <td>5</td>
                          <td>50</td>
                        </tr>
                    </table>
                  </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-6">
                  </div><!-- /.col -->
                  <div class="col-xs-6">
                  <div class="text-center" style="background-color: gray;">
                    <h3 style="color:white;">Total</h3>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$250</td>
                        </tr>
                        <tr>
                          <th>Descuento</th>
                          <td>%10</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>$225.00</td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- this row will not appear when printing -->
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
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>

@include('admin.invoices.buscarproducto')

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
                        $('#product_id').val(product.id);
                        $('#name').val(product.name);
                        $('#price').val(product.retail_price);//por defecto
                        $('#priceR').val(product.retail_price);
                        $('#priceW').val(product.wholesale_price);
                        $('#stock').val(product.stock);
                        $('#wholesale_cant').val(product.wholesale_cant);
                    },
                    onKeyEnterEvent: function () { 
                        var product = $("#code").getSelectedItemData();
                        $('#product_id').val(product.id);
                        $('#name').val(product.name);
                        $('#price').val(product.retail_price);//por defecto
                        $('#priceR').val(product.retail_price);
                        $('#priceW').val(product.wholesale_price);
                        $('#stock').val(product.stock);
                        $('#wholesale_cant').val(product.wholesale_cant);
                    }


                }
   };
    
  $("#code").easyAutocomplete(options);
</script>
<script type="text/javascript">
  function complete($id,$code,$name,$wholesale,$retail,$stock,$amount){
    $('#code').val($code);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#price').val($retail);//por defecto
    $('#priceR').val($retail);
    $('#priceW').val($wholesale);
    $('#stock').val($stock);
    $('#wholesale_cant').val($amount);

    $('#favoritesModal').modal('hide');
  };

</script>
<script type="text/javascript">
function price_select($amount,$wholesale_cant){
  if ($amount>=$wholesale_cant){
        $('#price').val(this.form.wholesale_price.value);
  }
  if ($amount>=$wholesale_cant){
        $('#price').val(this.form.retail_price.value);
  }
}
</script>

@endsection
 

