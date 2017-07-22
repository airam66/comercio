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
          <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
                   <th>Boton</th>

                    <tbody id="mostrar">
                      <tr>
                        
                        <td><br><button type="button" class="btn btn-primary " data                       
                        -toggle="modal" id="second" data-title="Buscar" data-target="#favoritesModalClient"><i class="fa fa-search"></i></button>
                         @include('partials.searchPeople')
                            </td>
                       
                        </tr>

                    </tbody> 
                       
                   </table>
          {!! Form::open(['route'=>'purchasesInvoice.store', 'method'=>'POST'])!!}
          <section>
              
             <div class="border">

                 <div class="row ">
                       
                      <div class="col-md-3 pull-left" >
                           
                           {!!Field::number('numberPurchaseI')!!}
                       </div>

                      
                      <div class="col-md-4  col-md-offset-2">
                            
                            {!!Field::number('numberPurchase')!!}
                         
                      </div>
                      <br>
                      <a id="searchP" type="button" class="btn btn-primary">Buscar </a>

                </div>
                
               </div>
      
              <div>
               
                <h3>Proveedor</h3>
                 <div class="row">
                       {!!Field::text('cuit',null)!!}
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
                       {!!Field::number('purchase_price',null,['disabled'])!!} 
 
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
                          <th>Subtotal Estimado</th>
                        </tr>
                      </thead>

                      <tbody id="detail">
                         
                      </tbody>

                    </table>
                  </div><!-- /.col -->


                  <div class="row">
                 
                  <div class="col-xs-6 pull-right">
                      <div class="text-center" style="background-color: gray;">
                        <h3 style="color:white;">Total Estimado</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th class="text-center">Total Estimado:</th>
                          <td class="text-center">$<input type="number" id="TotalCompra" name="TotalCompra" value=0 step="any" class="mi_factura"></td>
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
 @include('partials.searchProductsInvoice')

@endsection




