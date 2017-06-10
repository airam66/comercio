@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nuevo producto</h3>
           

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Cerrar">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            
          {!! Form::open(['route'=>'products.store', 'method'=>'POST', 'files'=>true])!!}
            
             {!! Field::text('name')!!}

              <div class= "form-group">
              {!! Form::label('category_id','Categoria')!!}
              {!! Form::select('category_id', $categories ,null, ['class'=>'form-control', 'placeholder'=>'Seleccione una categoria'])!!} 
              </div> 

             {!! Field::number('code')!!}
              
          
              {!! Field::file('image')!!}
          
              
              <div class= "form-group">
              {!! Form::label('events','Evento')!!}
              {!! Form::select('events[]', $events ,null, ['class'=>'form-control select-tag','multiple','placeholder'=>'Seleccione un evento'])!!}
              </div> 

              <div class= "form-group">
              {!! Form::label('line_id','Linea')!!}
              {!! Form::select('line_id', $lines ,null, ['class'=>'form-control','placeholder'=>'Seleccione una linea'])!!} 
              </div> 

              <div class= "form-group">
              {!! Form::label('brand_id','Marca')!!}
              {!! Form::select('brand_id', $brands ,null, ['class'=>'form-control','placeholder'=>'Seleccione una marca'])!!} 
              </div> 

              <div class="form-group">
              {!! Form::label('description','Descripcion')!!}
              {!! Form::text('description',null, ['class'=>'form-control'])!!}
              </div>
            

              {!! form::label('Precio')!!} 
              
              <input class="form-control" onkeyup="this.form.wholesale_price.value=parseFloat(this.value)+this.value*{{$porcentage->wholesale_porcentage}}/100;this.form.retail_price.value=parseFloat(this.value)+this.value*{{$porcentage->retail_porcentage}}/100;" name="purchase_price" type="number" whit step="any">

              
              {!! Field::number('wholesale_price','<input name="wholesale_price" type="number" with step="any">', ['class'=>'form-control','step'=>'any'])!!}

              {!! Field::number('retail_price','<input name="retail_price" type="number" with step="any">', ['class'=>'form-control','step'=>'any'])!!}


             {!! Field::number('stock')!!}

              {!! Field::number('wholesale_cant')!!}
            

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

@section('js')
<script>
  $('.select-tag').chosen({

    
  });

</script>
@endsection
