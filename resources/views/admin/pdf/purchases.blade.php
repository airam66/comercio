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
                      <td><a data-toggle="modal" id="first" data-title="detail" data-target="#chooseMonths"><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      @include('admin.pdf.chooseMonths')
                    
                    </tr>
                    <td>2</td>
                      <td>Reporte de Compras a Proveedores</td>
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