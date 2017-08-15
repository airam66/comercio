@extends('layouts.main')
@section('content')
<div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">REPORTES DEL SISTEMA</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                   
                    <thead><tr>
                      <th>ID</th>
                      <th>reporte</th>
                      <th>ver</th>
                      
                    </tr></thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Reporte de productos con bajo stock</td>
                      <td><a href="{{route('reportStock')}}" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                    
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Reporte de compras de proveedores</td>
                      <td><a data-toggle="modal" id="first" data-title="detail" data-target="#chooseDate"><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      @include('admin.pdf.ChooseDate')
                    
                    </tr>
                   
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
 </div>


 @endsection
 @section('js')
 <script type="text/javascript">
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
    startDate: '30-06-2015',
    endDate: '31-07-2015'

});


</script>
<script type="text/javascript">

     $('#daterange').on('change',function(){

    {{$startDate}}=$('#daterange') .data('daterangepicker').startDate.format('YYYY-MM-DD');
    {{$endDate}}=$('#daterange') .data('daterangepicker').endDate.format('YYYY-MM-DD');


});


</script>
 @endsection