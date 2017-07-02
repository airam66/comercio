@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nuevo proveedor</h3>
          </div>
          <div class="box-body">
            
          {!! Form::open(['route'=>'providers.store', 'method'=>'POST', 'files'=>true])!!}
            
              {!! Field::text('name')!!}

              {!! Field::number('cuit')!!}
              
              {!! Field::text('address')!!}
              <div class="col-md-6">
              {!! Field:: text('province')!!}
              </div>
              <div class="col-md-6">
              {!! Field:: text('location')!!}
              </div>
              <div class="col-md-6">
              {!! Field::text('email')!!}
              </div>
              <div class="col-md-6">
              {!! Field::number('phone')!!}
              </div>
              {!! Form::hidden('bill',0)!!}
              
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

