@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Venta</h3>
         <!-- <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
           
         </div>
          <div class="box-body">
          <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
                     
                      <div class="pull-right">
                         <b id="id">Venta N°: {{$invoice->id}}</b><br><br>
                         <b>Fecha: {{$invoice->created_at->format('d-m-Y')}}</b>
                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
                </div>
              <div class="row">
               <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-6 invoice-col">
            DE
            <address>
              <strong>Cotillon creaTu</strong><br>
              Direccion:Roque Saenz Peña Nro 14 bis 2 <br>
              B° San Martin,Rosario de Lerma, Salta<br>
              Telefono: (387)59662005 - (387) 5910201<br>
              Email:creatucotillon@gmail.com
            </address>
          </div><!-- /.col -->
          <div class="col-sm-6 invoice-col">
            A
            <address>
              <strong>SR/A :  {{$invoice->client->name}}</strong>
            </address>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
              </div>
                <!-- info row -->
      <div class="panel panel-default">
          <div class="panel-body ">
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Descripcion</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($detalles as $detalle )
                        <tr>
                          <td>{{$detalle->id}}</td>
                          <td>{{$detalle->name}}</td>
                          <td>{{$detalle->description}}</td>
                          <td>{{$detalle->amount}}</td>
                          <td>$ {{  $detalle->subTotal}}</td>
                        </tr>
                      @endforeach 
                      </tbody>
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
                          <td>$ {{$invoice->total}}</td>
                        </tr>
                        <tr>
                          <th>Descuento</th>
                          <td>{{$invoice->discount}}%</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>$ {{$invoice->total}}</td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">

                      <div class="form-group">
                       
                        <a onclick="location.href='{{route('print',$invoice->id)}}' "id="print" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Generar Comprobante</a>
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

