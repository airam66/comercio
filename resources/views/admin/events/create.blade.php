@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nuevo Evento</h3>
           

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Cerrar">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            
            {!! Form::open(['route'=>'events.store', 'method'=>'POST'])!!}

             <div class="form-group">
              {!! Field::text('name',null, ['class'=>'form-control'])!!}
             </div>


             
              <div class= "form-group">
  
              {!! Form::label('status','Estado')!!}
              {!! Form::select('status', ['activo'=>'activo','inactivo'=>'inactivo'],null,['class'=>'form-control'])!!} 
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
