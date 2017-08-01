@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Pago de Pedidos</h3>
          </div>
          <div class="box-body">
            
            {!! Form::open(['route'=>['OrderPayment.store',$order->id], 'method'=>'POST','files'=>true])!!}

  <div class="panel panel-default">

  <div class="panel-body">
             <div class="row">
              
                <div class="controls col-md-4">
                  <h4>N° Pedido: {{$order->id}}</h4>

                 </div> 
                 <div class="col-md-4 col-md-offset-0">
                  <h4>Fecha: {{$order->created_at->format('d/m/Y')}}</h4>

                 </div>
                  <div class="col-md-4 col-md-offset-0">
                  <h4>Entrega: {{date('d/m/Y', strtotime($order->delivery_date))}}</h4>

                 </div>




              </div>


              
             
             <div class="panel panel-info">

                <div class="panel-body">
                   
                        <div class="row "> 
                         <div class="controls col-md-4">
                          <h4>Cliente: {{$order->client->name}}</h4>
                         </div> 
                         <div class="col-md-4 col-md-offset-1">
                          
                           <h4>Cuit/Cuil : {{$order->client->cuil}}</h4>

                         </div>

                      </div>
                      
                </div>

                  
            </div>

            <div class="row "> 
                         <div class="controls col-md-4">
                          <h4>Total: ${{$order->total}}</h4>
                         </div> 
                         <div class="col-md-4 col-md-offset-0">
                          
                           <h4>Saldo : {{$order->client->bill}}</h4>

                         </div>

                      </div>
</div>
</div>

  <div class="panel panel-default">

    <div class="panel-body">
              <div class="row">

              <div class="controls col-md-4">
              <label>Monto:
               <input type="number" id="Rode" name="Rode" value=""  step="any" ></label>

               </div>
             <div class="checkbox col-md-3 col-md-offset-1">
                                  <label>
                                      <input id="totalPayment" name="totalPayment" type="checkbox"  onclick="dehabilitedRode('Rode');">
                                      Pago Total
                                  </label>
               </div> 
             </div>
             <div class="row">
             <div class="controls col-md-4">
             <label>Saldo:
             <input type="number" id="balance" name="balance" value="{{$order->client->bill}}" readonly="true" class="mi_factura"  step="any" ></label>
              </div>
             </div>
              
              
              

</div>
</div>              
              
             
              <div class="form-group">
              
                                          <button type="submit" class="btn btn-primary " name="Registrar Pago">
                                              Registrar Pago
                                      
                                          </button>
                               
                               
              </div>
          
 
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
<script >
$('#Rode').on('keyup', function(){

  $rode=$(this).val();

  $balance={{$order->client->bill}};
  if ($rode>$balance){
    alert('La cantidad ingresada es mayor al saldo');
    $('#Rode').val('');
    $balance={{$order->client->bill}};
    $('#balance').val($balance);
  }else{
    $balance=$balance-$rode;
  $('#balance').val($balance);
  }
  
  
})

</script>
<script>
function dehabilitedRode(Rode){
  var estadoActual=document.getElementById(Rode);
  if(estadoActual.disabled==true){
    estadoActual.disabled=false;
    $balance={{$order->client->bill}};
    $('#balance').val($balance);

  }else{
    estadoActual.disabled=true;
    $('#balance').val(0);
    $('#Rode').val('');
  }
  
}
</script>
@endsection
