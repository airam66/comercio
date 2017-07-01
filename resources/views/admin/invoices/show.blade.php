@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Venta</h3>
          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
           
         </div>
          <div class="box-body">
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
              <div class="row">
              </div>
                <!-- info row -->
      <div class="panel panel-default">
          <div class="panel-body "><!--busqueda prorducto-->
               
                <
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

             
 
             

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>




@endsection
