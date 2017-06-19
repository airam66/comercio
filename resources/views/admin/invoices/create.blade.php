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
                <div class="row invoice-info">

                <div class="col-md-3" >
                       
                         {!! form::label('Codigo')!!}
                  <input id="code" class="form-control " name="code" type="text" >
                  </div> 

                  <div class="col-md-1 col-md-offset-0" >
                  <br>
                   <button class="btn btn-primary "><i class="fa fa-search"></i></button>
                  </div>
                  <div class="col-md-4 col-md-offset-2">
                  {!!Field::number('Precio',null)!!}                     </div>

                 </div>

                <div class="row invoice-info">
                    <div class="col-md-6">
                    {!!Field::text('name',null)!!}
                    </div>
                    <div class="col-md-4">
                    {!! Field::number('stock')!!}
                    </div>


                </div>

                <div class="row invoice-info">

                  <div class="col-md-4">
                    {!! form::label('Cantidad')!!}
                    <input class="form-control" onkeyup="  " name="code" type="text">
                    </div>

                  <div class="col-md-4 col-md-offset-2">
                  <img src="{{ asset('images/cotillon.png ') }}" width="150" height="80"  >
                     
                    </div>
                  </div>



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
                    <p class="lead">Total</p>
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

@endsection
@section('js')
<script>
  $('.select-lines').chosen();
  var self = this;

self.on('mount',function(){
    __codeAutocomplete();
})

function __codeAutocomplete(){
  var product =$("#product");
  var opcions={
    url: function(q){ 
      return baseUrl('invoices/autocomplete?q='+q);
    },
    getValue: 'code',
    
    };
    
  $("#product").easyAutocomplete(options);
};

</script>
@endsection


