@extends('layouts.main')


@section('content')

  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Cambiar contraseña</h3>
          </div>
          
          <div class="box-body">
            
            {!! Form::open(['route'=>'users.changeMyPassword', 'method'=>'POST'])!!}


              {!! Field::password('password')!!}

              {!! Field::password('newpassword')!!}

              {!! Field::password('newpassword_confirmation')!!}
             
         
              <div class="form-group">
              {!! Form::submit('Guardar cambios',['class'=>'btn btn-primary'])!!}
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