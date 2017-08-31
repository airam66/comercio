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
                      <th>N°</th>
                      <th>Reporte</th>
                      <th></th>
                      
                    </tr></thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Reporte de productos con bajo stock</td>
                      <td><a href="{{route('reportStock')}}" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                    
                    </tr>
                    <tr>
                      
                    
                   
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