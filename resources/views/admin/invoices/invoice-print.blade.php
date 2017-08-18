@extends('layouts.main')
 
 
@section('content')
  <div onload="window.print();">
     <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            
         <!-- <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
           
         </div>
          <div class="box-body">
          <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                    <p align="left">
                        <img src="{{ asset('images/cotillon.png ') }}" 
                        width="230" height="80"  ><p>
                        
                     
                      <div class="pull-right">
                         <b id="id">Comprobante N°: {{$invoice->id}}</b><br><br>
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
              <strong>Cotillón CreaTu</strong><br>
              <strong>CUIT: 38335256729</strong><br>
              Dirección:Roque Saenz Peña Nro 14 bis 2 <br>
              B° San Martin,Rosario de Lerma, Salta<br>
              Telefono: (387)59662005 - (387) 5910201<br>
              Email:creatucotillon@gmail.com
            </address>
          </div><!-- /.col -->
          <div class="col-sm-6 invoice-col">
            A
            <address>
              <strong>SR/A:  {{$invoice->client->name}}</strong>

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
                        <tr style="background-image:url('{{ asset('images/barra1.png ') }}')">
                          <th>Cantidad</th>
                          <th>Detalle</th>
                          <th>Precio</th>
                          
                          <th>Importe</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($detalles as $detalle )
                        <tr>
                          <td>{{$detalle->amount}}</td>
                          <td>{{$detalle->name}}</td>                      
                          <td> {{$detalle->price}}</td>
                          <td>$ {{$detalle->subTotal}}</td>
                        </tr>
                      @endforeach 
                      </tbody>
                    </table>
                  </div><!-- /.col -->
                </div><!-- /.row -->

         
                  <!-- accepted payments column -->
                 -
                  <div class="col-xs-6 pull-right">
                  <div class="text-center" style="background-image:url('{{ asset('images/barra2.png ') }}')" >
                    <h3 >Total</h3>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$ {{$invoice->total}}</td>
                        </tr>
                        <tr>
                          <th>Descuento</th>
                          <td>{{$invoice->discount}} %</td>
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
                       
                        <a onclick="window.print()" id="print" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                       </div>
                  </div>
                </div> 
               
              </section><!-- /.content -->

              <div class="row ">
                <div class=" col-xs-12 text-center">
            
                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Comprobante no valido como factura. Contillón Creatu.
                  </p>
               </div>
 
             

          </div>
          <!-- /.box-body -->

        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>


  </div>
  @endsection
