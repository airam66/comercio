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

             {!! Field::number('code')!!}

              
             <div class="form-group">

              {!! Form::label('image','Imagen')!!}
              {!! Form::file('image')!!}
             </div>
              

              <div class= "form-group">
  
              {!! Form::label('category_id','Categoria')!!}
              {!! Form::select('category_id', $categories ,null, ['class'=>'form-control'])!!} 
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
            
             

              <div class= "form-group">
  
              {!! Form::label('price','Price')!!}
              {!! Form::number('price',null, ['class'=>'form-control','step'=>'any'])!!}
              </div>

             {!! Field::number('stock')!!}

               <div class= "form-group">
  
              {!! Form::label('status','Estado')!!}
              {!! Form::select('status', ['active'=>'activo','inactive'=>'inactivo'],null,['class'=>'form-control'])!!} 
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
