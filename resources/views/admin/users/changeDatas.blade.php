@extends('layouts.main')

@section('content')

 <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Actualizar mis datos</h3>
          </div>
          
          <div class="box-body">
            
            {!! Form::open(['route'=>'users.changeMyDatas', 'method'=>'PATCH', 'files'=>true])!!}

              {!! Field::text('name',Auth::user()->name)!!}

               <label>Foto Actual</label><br>
              <div>             
               <img src="{{ asset('images/users/'.Auth::user()->photo_name)  }}"  width="160" height="150" >
              </div>
              {!! Field::file('photo')!!}

              <label> Localidad</label><br>
              {!! Form::select('location',['Rosario de Lerma'=>'Rosario de Lerma','Salta'=>'Salta','San Lorenzo'=>'San Lorenzo','Cerrillos'=>'Cerrillos','Chicoana'=>'Chicoana','La Merced'=>'La Merced'],Auth::user()->location,['class'=>'form-control chosen-select'])!!} 
              <br>

              {!! Field::text('address',Auth::user()->address)!!}
             
              {!! Field::number('phone',Auth::user()->phone)!!}
              
               {!! Field::email('email',Auth::user()->email,['disabled'])!!}
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

@section('js')
<script>
  $('.chosen-select').chosen({
  no_results_text: 'No hay resultados'
});
</script>
@endsection