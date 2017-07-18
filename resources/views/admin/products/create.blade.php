@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nuevo producto</h3>
          
          </div>
          <div class="box-body">
            
          {!! Form::open(['route'=>'products.store', 'method'=>'POST', 'files'=>true])!!}
            
              {!! Field::text('name')!!}

              {!! Field::select('category_id', $categories, ['class'=>'select-category','empty'=>'Seleccione una categoria'])!!} 
       

              {!! Field::number('code')!!}
              
          
              {!! Field::file('image')!!}
          
              
              <div class= "form-group">
              {!! Form::label('events','Evento')!!}
              {!! Form::select('events[]', $events ,null, ['class'=>'form-control select-tag','multiple'])!!}
              </div> 

              {!! Field::select('line_id', $lines ,['class'=>'select-lines','empty'=>'Seleccione una linea'])!!} 

              {!! Field::select('brand_id', $brands, ['class'=>'select-brands','empty'=>'Seleccione una marca'])!!} 
          

              <div class="form-group">
              {!! Field::text('description',null, ['class'=>'form-control'])!!}
              </div>
              
              <div class="controls col-md-4">
             {!! Field::number('purchase_price',null, ['class'=>'form-control','step'=>'any'])!!}
             </div>

              <div class="col-md-3 col-md-offset-1">
              {!! Field::number('retail_price',null, ['class'=>'form-control','step'=>'any'])!!}
              </div>
              <div class="col-md-3 col-md-offset-1">
              {!! Field::number('wholesale_price',null, ['class'=>'form-control','step'=>'any'])!!}
              </div>


              {!! Field::number('stock')!!}

              {!! Field::number('wholesale_cant')!!}
            

              <div class= "form-group">
              {!! Form::label('status','Estado')!!}
              {!! Form::select('status', ['activo'=>'activo','inactivo'=>'inactivo'],null,['class'=>'form-control'])!!} 
              </div>
              {!! Form::hidden('route',$route)!!}
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
  $('.select-tag').chosen({
    placeholder_text_multiple: "Seleccione los eventos",
  });
  $('.select-category').chosen();
  $('.select-brands').chosen();
  $('.select-lines').chosen();

</script>
<script >
  $('#purchase_price').on('keyup', function(){
    $('#wholesale_price').val(parseFloat(this.value)+this.value*{{$porcentage->wholesale_porcentage}}/100);
    $('#retail_price').val(parseFloat(this.value)+this.value*{{$porcentage->retail_porcentage}}/100);
  });
</script>
@endsection
