@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Orden de Compra</h3>
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
                         <b id="id">Orden de Compra N°: {{$purchase->id}}</b><br><br>
                         <b>Fecha: {{$purchase->created_at->format('d-m-Y')}}</b>
                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
                </div>
              <div class="row">
               <!-- info row -->
             <h3><b>Proveedor</b></h3>
           
                
                <div class="row ">
                         <div class="col-md-6 " >
                           
                           <h4><strong>Cuit: </strong> {{$purchase->provider->cuit}} </h4>
                           
                         </div>
                       
                      <div class="col-md-4  col-md-offset-2 pull-right">
                            
                            <h4><strong>Nombre: </strong> {{$purchase->provider->name}}</h4>
                            
                            
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
                          <th>Nombre</th>
                          <th>Marca</th>
                          <th>Precio Compra</th>
                          <th>Cantidad</th>
                          <th>Subtotal Estimado</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($details as $detail )
                        <tr>
                          <td>{{$detail->product_name}}</td>
                          <td>{{$detail->brand_name}}</td>
                          <td>{{$detail->price}}</td>
                          <td>{{$detail->amount}}</td>
                          <td>{{$detail->subTotal}}</td>
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
                          <th>Total:</th>
                          <td>{{$purchase->total}}</td>
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
                        <a href="{{route('purchases.show',$purchase->id)}}" target="_blank" > 
                              <button  type="button" class="btn btn-primary "  >
                               Generar PDF</button>
                        </a>
                        <!--Boton generar Editar-->
                         <a href="{{route('purchases.edit',$purchase->id)}}"  >

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