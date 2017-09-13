@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Pedidos</h3>
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
                         <b id="id">Pedido N°: {{$order->id}}</b><br>
                         <b>Fecha: {{$order->created_at->format('d/m/Y')}}</b><br>
                         <b>Entrega:{{date('d/m/Y', strtotime($order->delivery_date))}}</b>

                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
                </div>
              <div class="row">
              <div class="panel panel-info">

                <div class="panel-body">
                   
                        <div class="row "> 
                         <div class="controls col-md-6 pull-left">
                          <h4>Cliente: {{$order->client->name}}</h4>
                         </div> 
                         <div class="col-md-6  pull-right">
                          
                           <h4>Cuit/Cuil : {{$order->client->cuil}}</h4>

                         </div>

                      </div>
                      
                </div>

                  
            </div>

             
          
              </div><!-- /.row -->
              <hr>
        
                <!-- info row -->
      <div class="panel panel-default">
          <div class="panel-body ">
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Producto</th>  
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($details as $detail )
                        <tr>
                          <td>{{$detail->product_name}}</td>
                          
                          <td>${{$detail->price}}</td>
                          <td>{{$detail->amount}}</td>
                          <td>${{$detail->subTotal}}</td>
                        </tr>
                      @endforeach 
                      </tbody>
                    </table>
                  </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                  <div class="col-xs-6">
                     <div class="text-center" style="background-color: gray;">
                    <h3 style="color:white;">Pagos</h3>
                    </div>
                    <div class="table-responsive">
                    @if($payments->isNotEmpty())
                      <table class="table">
                        <tr>
                          <th class="text-center">Fecha</th>
                           <th class="text-center">Monto pagado</th>
                           <th class="text-center">Saldo a pagar</th>
                        </tr>
                        <tbody>
                           @foreach($payments as $payment)
                           <tr>
                             <td class="text-center">{{$payment->created_at->format('d/m/Y')}}</td>
                             <td class="text-center">${{$payment->amount_paid}}</td>
                             <td class="text-center">${{$payment->balance_paid}}</td>
                           </tr>

                            @endforeach
                        </tbody>
                      </table>
                    @else
                    <div class="text-center">No se registraron pagos</div>
                    @endif
                    </div>
                  </div><!-- /.col -->

                  <div class="col-xs-6">
                  <div class="text-center" style="background-color: gray;">
                    <h3 style="color:white;">Total</h3>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          @if($order->discount!=0)
                            <td>${{($order->total/9)*10}}</td>
                          @else
                            <td>${{$order->total}}</td>
                          @endif
                        </tr>
                        <tr>
                          <th>Descuento</th>
                          <td>{{$order->discount}}%</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>${{$order->total}}</td>
                        </tr>
                        <tr>
                          <th>Saldo a pagar:</th>
                          <td>${{$order->total-$order->totalPayments()}}</td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">

                      <div class="form-group">
                       <!--Boton generar PDF-->
                        <a href="{{route('orders.pdf',$order->id)}}" target="_blank" > 
                              <button  type="button" class="btn btn-primary "  >
                               Generar PDF</button>
                        </a>
                        <!--Boton generar Editar-->
                         <a href="{{route('orders.edit',$order->id)}}"  >

                                <button type="submit" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                                </button>
                        </a>
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