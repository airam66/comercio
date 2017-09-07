@extends('layouts.main')
@section('content')
<div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">REPORTES DE PRODUCTOS</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                   
                    <thead><tr>
                      <th width="10px">N°</th>
                      <th>Reporte</th>
                      <th></th>
                      
                    </tr></thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Reporte de productos con bajo stock</td>
                      <td>
                      <input name="today" value="{{date('Y-m-d')}}" type="hidden">
                      <a href="{{route('reportStock')}}" target="_blank" ><button class="btn btn-primary">Ver</button></a></td>
                    </tr>
                    <tr>
                    <td>2</td>
                      <td>Reporte de productos más vendidos</td>
                      <td><a href="{{route('reportRanKing')}}" target="_blank" ><button class="btn btn-primary">Ver</button></a></td>
                    </tr>
                     
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
 </div>
<div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">REPORTES DE PRODUCTOS CON FILTROS</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                   
                    <thead><tr>
                      <th width="10px">N°</th>
                      <th>Reporte</th>
                      <th></th>
                      
                    </tr></thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Reporte de productos vendidos mensualmente</td>
                      <td>
                        <form action="createReportSalesProducts"  method="GET" target="_blank">
                          <div class="col-md-4">
                              {!! Field::select('from_number', $months, ['empty'=>'Seleccione un mes'])!!}
                           </div>
                          <div class="col-md-4">
                             {!! Field::select('to_number', $months, ['empty'=>'Seleccione un mes'])!!}   
                          </div>                           
                           <br>                     
                          <button type="submit" class="btn btn-primary">
                                  Ver
                          </button>
                         </form> 
                      </td>
                    </tr>                   
                   
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
 </div>

 @endsection
 @section('js')
<script>
  $('.input-daterange input').each(function() {
    $(this).datepicker({
         language: "es",
         autoclose: true,
         format:"yyyy/mm/dd"
    });
});


</script>


 @endsection