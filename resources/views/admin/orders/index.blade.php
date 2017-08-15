@extends('layouts.main')


@section('content')

<div class="box box-primary">

   <div class="box-header ">
      <div class="row">
           <h2 class="box-title col-md-5">Listado de Pedidos</h2>
      </div>

      <div class="row">
        <div class='col-sm-4 pull-right'>
            <form route='orders.index'  method="GET">
            <div class="input-group">
              <input type="text" name="searchClient" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
           </form>
       </div>


        <div class='col-sm-4 pull-left'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                     <input type="text" id="daterange"  name="daterange" class="form-control" value="seleccione una fecha"/>          
                     <span class="input-group-addon">
                        <a href="{{route('orders.index')}}"> <span  class="glyphicon glyphicon-calendar"></span>
                      </span></a>
                </div>
            </div>
         </div>
       </div>
        
        <div class="row">
         <div class='col-sm-2 pull-left'>
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
		                <th>Estado</th>
		                <th>Saldo a pagar</th>
		                <th></th>
                    <th></th>

		                 
		            </tr>
		        </thead>
		     
       
                <tbody id="mostrar">
                   @foreach ($orders as $key => $order) 
                         
			                <tr>
			                              
			                        <td>{{$order->id}}</td>
			                        <td>{{$order->created_at->format('d/m/Y')}}</td>
			                        <td>{{date('d/m/Y', strtotime($order->delivery_date))}}</td>
			                        <td>{{$order->client->name}}</td>
			                        <td>{{$order->status}}</td>
			                        <td>${{$order->client->bill}}</td>
			                        <td> 
                                
                                <a href="{{route('orders.show',$order->id)}}" > <button  type="button" class="btn btn-info "  ><span class="fa fa-list" aria-hidden="true" ></span></button></a>
                                <a href="{{route('orderPayment.register',$order->id)}}" > <button  type="button" class="btn btn-primary "  ><span class="fa fa-usd" aria-hidden="true" ></span></button></a>
                      
                                 <a href="{{route('orders.pdf',$order->id)}}" target="_blank" > <button  type="button" class="btn btn-primary "  ><i class="fa fa-print"></i> 
                                 Generar PDF</button></a>
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
 var hoy= new Date();
$('input[name="daterange"]').daterangepicker(
{
    locale: {
      format: 'DD-MM-YYYY',
      "separator": " - ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
       
    },
    startDate: hoy.getMonth()+"/"+hoy.getDate()+"/"+hoy.getFullYear(),
    endDate: hoy

});
</script>

<script type="text/javascript">

  $('#daterange').on('change',function(){

var f1=$('#daterange') .data('daterangepicker').startDate.format('YYYY-MM-DD');
var f2=$('#daterange') .data('daterangepicker').endDate.format('YYYY-MM-DD');

  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchDateOrder')}}",
    data:{'fecha1':f1,
          'fecha2':f2},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })



    
});


</script>


@endsection