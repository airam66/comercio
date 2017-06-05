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
              {!! Form::select('category_id', $categories ,null, ['class'=>'form-control'])!!} 
              </div> 

             {!! Field::number('code')!!}
              
          
              {!! Field::file('image')!!}
          
              
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
            
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <td><table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
              {!! form::label('Precio')!!}
              <p><input onkeyup="this.form.wholesale_price.value=parseFloat(this.value)+this.value*{{$porcentage->wholesale_porcentage}}/100;this.form.retail_price.value=parseFloat(this.value)+this.value*{{$porcentage->retail_porcentage}}/100;" name="purchase_price" type="number" whit step="any"></p>
              </table></td>
              <td><table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
              {!! Form::label('Precio por Mayor')!!}
              <p><input name="wholesale_price" type="number" with step="any"> </p>        
              </table></td>
              <td><table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
              {!! Form::label('Precio por menor')!!}
              <p><input name="retail_price" type="number" with step="any"></p>
              </table></td>
               </table> 

             {!! Field::number('stock')!!}

              {!! Field::number('wholesale_cant')!!}
            

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
