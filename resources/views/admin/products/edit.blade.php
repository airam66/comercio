@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Modificar producto</h3>
           

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Cerrar">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            
            {!! Form::model($product,['route'=>['products.update',$product->id], 'method'=>'PATCH', 'files'=>true])!!}

              <div class= "form-group">
              {!! Form::label('category_id','Categoria')!!}
              {!! Form::select('category_id', $categories ,null, ['class'=>'form-control'])!!} 
              </div> 

             {!! Field::number('code')!!}
                    
                    <div>
                    <img src="{{ asset('images/products/'.$product->extension)  }}" width="40" height="40" > Imagen Actual
                    </div>

             <div class="form-group">
              {!! Form::label('image','Nueva Imagen')!!}
              {!! Form::file('image')!!}
             </div>
              
              <div class= "form-group">
              {!! Form::label('event_id','Evento')!!}
              {!! Form::select('event_id', $events ,null, ['class'=>'form-control'])!!}
              </div> 

              <div class= "form-group">
              {!! Form::label('line_id','Linea')!!}
              {!! Form::select('line_id', $lines ,null, ['class'=>'form-control'])!!} 
              </div> 

              <div class= "form-group">
              {!! Form::label('brand_id','Marca')!!}
              {!! Form::select('brand_id', $brands ,null, ['class'=>'form-control'])!!} 
              </div> 

              <div class="form-group">
              {!! Form::label('description','Descripcion')!!}
              {!! Form::text('description',null, ['class'=>'form-control'])!!}
              </div>

             {!! Field::number('stock')!!}

              <div class="form-group">
              {!! Form::label('wholesale_cant','Cantidad de venta Mayorista')!!}
              {!! Form::number('wholesale_cant',null, ['class'=>'form-control'])!!}
              </div>

              <div class="form-group">
              {!! Form::submit('Guardar Cambios',['class'=>'btn btn-primary'])!!}
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
