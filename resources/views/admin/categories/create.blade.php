@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nueva categoria</h3>
          </div>
          <div class="box-body">
            
            {!! Form::open(['route'=>'categories.store', 'method'=>'POST','files'=>true])!!}

             <div class="form-group">
              {!! Field::text('name',null, ['class'=>'form-control'])!!}
             </div>


              <div class="form-group">

              {!! Form::label('description','Descripcion')!!}
              {!! Form::text('description'," ", ['class'=>'form-control'])!!}
              </div>
              
              {!! Field::file('image')!!}
            
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
