@extends('layouts.main')

@section('content')
<div class="box box-primary">

   <div class="box-header ">
      <div class="row">
           <h2 class="box-title col-md-5">Listado de Movimientos</h2>
      </div>
      <div class="row">
        <div class='col-sm-2 pull-right'>
           <br>
            <input type ='button' class="btn btn-success"  value='Agregar' onclick="location.href = '{{ route('movements.create') }}'"/> 
        </div>
        <div class='col-sm-6 pull-left'>
          <br>
           <form route='movements.index'  method="GET">
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
         <br>
         <form route='movements.today'  method="GET">
                 <input name="today" value="{{date('Y-m-d')}}" type="hidden">
                 <button type="submit" class="btn btn-primary">
                                  HOY
                 </button>
         </form>
       </div>

       <div class="box-body" id="orders">              
          @if($movements->isNotEmpty()) 
             <table id="table table-striped" class="display table table-hover" cellspacing="0" width="100%">
          
		        <thead>
		            <tr>
		                <th>Concepto</th>
		                <th>Fecha</th>
		                <th>Hora</th>
		                <th>Tipo</th>
                        <th>Monto</th>
                        <th></th>
                   </tr>
		        </thead>
		     
       
                <tbody id="mostrar">
                   @foreach ($movements as $movement) 
                       <tr>
			              <td>{{$movement->concept}}</td>
			              <td>{{$movement->created_at->format('d-m-y')}}</td>  
			              <td>{{date_format($movement->created_at,'H')}}:{{date_format($movement->created_at,'i')}}</td> 
			              <td>{{$movement->type}}</td>
			              <td>${{$movement->rode}}</td>
			           </tr>     
                    @endforeach

                </tbody>
            </table>
            <br>
            <div class="row">
              <div class="pull-right" >
	            <table class="table table-bordered" style="width: 150px">
                    <tr>
	                  <th  class="text-center">TOTAL CAJA</th>
	                </tr>
	                <tr>
	                  <td  class="text-center">${{$total}}</td>   
	                </tr>	                
	             </table>
	           </div>
	           <div class=" pull-right">
	             <table class="table table-bordered" style="width: 150px">
	                <tr>
	                  <th  class="text-center">TOTAL SALIDAS</th>
	                </tr>
	                <tr>
	                  <td  class="text-center">${{$totalOutcomes}}</td>  
	                </tr>
	             </table>
	            </div>
	            <div class=" pull-right">
	             <table class="table table-bordered" style="width: 150px">
	                <tr>
	                  <th  class="text-center">TOTAL ENTRADAS</th>
	                </tr>
	                <tr>
	                  <td  class="text-center">${{$totalIncomes}}</td>
	                  
	                </tr>
	             </table>
	            </div>
            </div>
         <div class="text-center">
         {!!$movements->render()!!}
        </div>
        @elseif($fecha1 == null && $fecha2 == null)
          <div class="alert alert-dismissable alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>No hubo moviemientos el día de hoy.</p>
        </div>
        @else
         <div class="alert alert-dismissable alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>No se encontró ningún movimiento entre {{$fecha1}} y {{$fecha2}} .</p>
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

@endsection