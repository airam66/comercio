@extends('layouts.main')
@section('content')
 <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">REPORTES DE COMPRAS</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                   
                    <thead><tr>
                      <th>N°</th>
                      <th>Reporte</th>
                      <th></th>
                      
                    </tr></thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Reporte de Compras Mensuales</td>
                      <td>
                        <form action="createReportSalesProducts"  method="GET" target="_blank">
                          
                          <div class="input-group date">
                            <div class="input-group input-daterange">
                              <div class="input-group-addon">DESDE</div>
                                {!! Form::select('from_number',$months ,null, ['class'=>'form-control','placeholder'=>'......  Seleccione un mes  ..... '])!!}
                                 
                             <div class="input-group-addon">HASTA</div>
                                {!! Form::select('to_number',$months ,null, ['class'=>'form-control','placeholder'=>'...... Seleccione un mes  ..... '])!!}
                             <div class="input-group-addon">
                    
                                <button type="submit" class="btn btn-primary">
                                  Ver
                      </button>
                  </div>
                </div>
              </div>
                         </form> 
                      </td>
                     
                    
                    </tr>
                    <td>2</td>
                      <td>Reporte de Compras a Proveedores</td>
                      <td>
                       <form action='createReportPPurchase'  method="GET" target="_blank" >
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha" id="fecha1">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha" id="fecha2">
                  <div class="input-group-addon">
                    
                    <button type="submit" class="btn btn-primary">
                                  Ver
                      </button>
                  </div>
                </div>
              </div>
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