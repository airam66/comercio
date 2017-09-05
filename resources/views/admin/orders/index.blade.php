@extends('layouts.main')


@section('content')

<div class="box box-primary">

   <div class="box-header ">
      <div class="row">
           <h2 class="box-title col-md-5">Listado de Pedidos</h2>
      </div>

      <div class="row">
        <div class='col-sm-4 pull-right'>
          <br>
            <form route='orders.index'  method="GET">
            <div class="input-group">
              <input type="text" name="searchClient" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
           </form>
       </div>


        <div class='col-sm-6 pull-left'>
          <br>
           <form route='orders.index'  method="GET">
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">
                        <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-calendar"></i>
                                  </button>
                  </div>
                </div>
              </div>

            </form>
         </div>
       </div>
        
        <div class="row">
         <div class='col-sm-2 pull-left'>
           <br>
            <input type ='button' class="btn btn-success"  value = 'Agregar' onclick="location.href = '{{ route('orders.create') }}'"/> 
        </div>

   </div>

     <div class="box-body" id="orders">              
      @if($orders->isNotEmpty()) 
        <table id="table table-striped" class="display table table-hover" cellspacing="0" width="100%">
          
		        <thead>
		            <tr>
		                <th>N° Pedido</th>
		                <th>Fecha Pedido</th>
		                 <th>Fecha Entrega</th>
		                <th>Cliente</th>
                    <th>Saldo a pagar</th>
		                <th>Estado</th>
		                <th></th>
                    <th></th>
               </tr>
		        </thead>
		     
       
                <tbody id="mostrar">
                   @foreach ($orders as $order) 
                         
			                <tr>
			                        <td>{{$order->id}}</td>
                              <td>{{$order->created_at->format('d/m/Y')}}</td>
                              <td>{{date('d/m/Y', strtotime($order->delivery_date))}}</td>
                              <td>{{$order->client->name}}</td>
                              <td>${{$order->client->bill}}</td>
                              <td>
                              {!! Form::open(['route'=>['orders.changeStatus',$order->id],'method'=> 'PUT']) !!}         
			                        
                              @if($order->status=="pendiente")
                                {!! Form::select('status',['pendiente'=>'Pendiente','proceso'=>'En proceso','preparado'=>'Preparado','entregado'=>'Entregado'],$order->status,['class'=>'label label-danger'])!!} 
                              @endif

                               @if($order->status=="proceso")
                                {!! Form::select('status',['pendiente'=>'Pendiente','proceso'=>'En proceso','preparado'=>'Preparado','entregado'=>'Entregado'],$order->status,['class'=>'label label-warning'])!!} 
                              @endif
                              
                               @if($order->status=="preparado")
                                {!! Form::select('status',['pendiente'=>'Pendiente','proceso'=>'En proceso','preparado'=>'Preparado','entregado'=>'Entregado'],$order->status,['class'=>'label label-primary'])!!} 
                              @endif
                              
                               @if($order->status!='entregado')
                              <button type="submit" onclick="return confirm('¿Seguro quiere cambiar el estado?')" name="changeStatus">
                                      <span class="fa fa-star-o" aria-hidden="true"></span></button>
                               @else

                                 <span class="label label-success">Entregado</span>
                              @endif
                              </td>
			                     
                              {!!Form::close()!!}
                             
			                        <td> 
                                
                                <a href="{{route('orders.show',$order->id)}}" > <button  type="button" class="btn btn-info "  ><span class="fa fa-list" aria-hidden="true" ></span></button></a>
                                <a href="{{route('orderPayment.register',$order->id)}}" > <button  type="button" class="btn btn-primary "  ><span class="fa fa-usd" aria-hidden="true" ></span></button></a>
                      
                                 <a href="{{route('orders.pdf',$order->id)}}" target="_blank" > <button  type="button" class="btn btn-primary "  ><i class="fa fa-print"></i> 
                                 </button></a>
                                <a href="{{route('orders.edit',$order->id)}}"  >
                                          <button type="submit" class="btn btn-warning" name="edit">
                                              <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                                      
                                          </button>
                                </a>
                               
                                </td><td>
                                  {!!Form::open(['route'=>['orders.destroy',$order->id],'method'=>'DELETE'])!!}
                                      
                                        <button type="submit" onclick="return confirm('¿Seguro dará de baja este pedido?')" class="btn btn-danger" name="delete">
                                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                                        </button>
                                      
                                   {!!Form::close()!!}
                               
			                        </td>
			               </tr>

                 
                         
                    @endforeach

              </tbody>
         </table>
         <div class="text-center">
         {!!$orders->render()!!}
        </div>

        @elseif($fecha1 != null && $fecha2 != null)
         <div class="alert alert-dismissable alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>No se encontró ningún pedido entre {{$fecha1}} y {{$fecha2}}.</p>
        </div>
        @else
        <div class="alert alert-dismissable alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>No se encontró ningún pedido del cliente ingresado.</p>
        </div>

        @endif

     </div>
 </div>

@endsection

@section('js')
 <script type="text/javascript">

$('.input-daterange input').each(function() {
    $(this).datepicker({
         language: "es",
         autoclose: true,
         format:"yyyy/mm/dd"
    });
});


</script>

<script type="text/javascript">

$('#favoritesModalStatus').on('shown.bs.modal', function () {
  $('.yo').focus()
})

function productStockProvider(){
}


</script>

@endsection