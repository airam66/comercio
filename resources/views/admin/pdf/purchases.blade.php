@extends('layouts.main')
@section('content')
 <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Reporte de Compras Mensuales</h3>
         </div>
      <div class="box-body">
                    <!-- form busqueda -->
                      <form action='viewReportPurchase'  method="GET">
                            
                      
                      <div class="col-md-4 pull-left">
                          {!! Field::select('from_number', $months, ['class'=>'select-month','empty'=>'Seleccione un mes'])!!}
                       </div>
                       <div class="col-md-4  col-md-offset-1">

                           {!! Field::select('to_number', $months, ['class'=>'select-month','empty'=>'Seleccione un mes'])!!}   
                        </div>                           
                        <br>
                        <div class="pull-left">
                            <div class="form-group">
                             {!! Form::submit('buscar',['class'=>'btn btn-primary'])!!}
                            </div>
                         </div> 
                   
                          
                      </form> 
                    </div>
                  </div>
                     <!-- /form  busqueda-->

                  

                </div><!-- /.box-header -->
            
              </div><!-- /.box -->
            </div>
 @endsection
 @section('js')
<script>

  $('.select-month').chosen();

</script>
@endsection