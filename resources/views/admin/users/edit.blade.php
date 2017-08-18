@extends('layouts.main')

@section('content')

 <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Modificar usuario</h3>
          </div>
          
          <div class="box-body">
            
            {!! Form::model($user,['route'=>['users.update',$user->id], 'method'=>'PATCH', 'files'=>true])!!}

              {!! Field::text('name')!!}
        
              {!! Field::file('photo')!!}

              {!! Field::select('role_id', $roles ,['class'=>'select-roles','empty'=>'Seleccione un rol'])!!} 
         
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

@section('js')
<script>
  $('.select-roles').chosen();

</script>
@endsection

   
