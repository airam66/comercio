@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Actualizar Porcentajes de Ventas</h3>
           

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Cerrar">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            
            {!! Form::open(['route'=>'porcentages.store', 'method'=>'POST', 'files'=>true])!!}

              <div class= "form-group">
              {!! Form::label('wholesale_porcentage','Para venta mayorista')!!}
              {!! Form::number('wholesale_porcentage',null, ['class'=>'form-control'])!!}
              </div>

              <div class= "form-group">
              {!! Form::label('retail_porcentage','Para venta minorista')!!}
              {!! Form::number('retail_porcentage',null, ['class'=>'form-control'])!!}
              </div>

              <div class="form-group">
              {!! Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
              </div>
          
 
              {!! Form::close() !!}

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>
@endsection
