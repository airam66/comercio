@extends('layouts.main')

@section('content')

 <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nuevo usuario</h3>
          </div>
          
          <div class="box-body">
            
            {!! Form::open(['route'=>'users.store', 'method'=>'POST','files'=>true])!!}

              {!! Field::text('name')!!}
        
              {!! Field::email('email')!!}

              {!! Field::password('password')!!}

              {!! Field::password('password_confirmation')!!}
             
              {!! Field::file('photo')!!}
         
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