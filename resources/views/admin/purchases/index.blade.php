@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<div class="row">
    <h2 class="box-title col-md-5">Listado de Orden de Compras</h2>
</div>
      <div class="row">
      <div class='col-sm-2 pull-right'>
        <input type ='button' class="btn btn-success"   value = 'Agregar' onclick="location.href = '{{ route('purchases.create') }}'"/> 
        </div>
        <div class='col-sm-6 pull-left'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                     
                     <input type="text" id="daterange"  name="daterange" class="form-control" value="seleccione una fecha"  >          
                     <span class="input-group-addon">
                        <a href="{{route('purchases.index')}}"> <span  class="glyphicon glyphicon-calendar"></span>
                       </span></a>


                </div>
            </div>

        </div>
      </div>

</div>

<div class="box-body">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th>N° Orden Compra</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th></th>
                 
            </tr>
        </thead>
     
       
<tbody id="mostrar">
   @foreach ($purchases as $key => $purchase) 
         
                @if ($purchase->status!='rechazada')
                  
                <tr>
                              
                        <td>{{$purchase->id}}</td>
                        <td>{{$purchase->created_at->format('d/m/Y')}}</td>
                        <td>{{$purchase->provider->name}}</td>
                        <td>{{$purchase->status}}</td>
                        <td>

                       <a href="{{route('purchases.show',$purchase->id)}}" target="_blank" > <button  type="button" class="btn btn-primary "  >
                         Generar PDF</button></a>
                        @if ($purchase->status!='rechazada')
                             <a href="{{route('purchases.desable',$purchase->id)}}" onclick="return confirm('¿Seguro dara de baja el producto?')">
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
                       @endif    
  

                        <a href="{{route('purchases.edit',$purchase->id)}}"  >
                                <button type="submit" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                                </button>
                        </a>
                        <a href="#" target="_blank" > <button  type="button" class="btn btn-primary "  >
                        Ver detalle</button></a>
                  </td>
                  </tr>

                    @endif
                         
        @endforeach

</tbody>
    </table>




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
    url:  "{{ URL::to('admin/searchData')}}",
    data:{'fecha1':f1,
          'fecha2':f2},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })



    
});


</script>

<script type="text/javascript">
function myDelete(id){
  $.ajax({

type: "POST",
url: "{{ URL::to('admin/purchases/desable')}}",
data: { id: id }
});

}
</script>


@endsection