@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
         <div class="box box-info">
            <div class="box-header with-border">
               <h3 class="box-title">Registrar material de productos Creatú</h3>
            </div>
        
      <div class="box-body">
          {!! Form::open(['route'=>'products.updateStockCreateProduct', 'method'=>'POST'])!!}
          <section>
           <div class="panel-body borde"><!--busqueda prorducto-->
                  <h3>Producto</h3>
                <div class="row " >
                    <div class="col-md-3 pull-left" >
                         {!! form::label('Codigo')!!}
                         <input id="code" class="form-control" name="code" type="text" >
                         <input id="product_id" class="form-control " name="product_id" type="hidden" >
                    </div> 
                    <div class="pull-left">
                    <br>
                       <button type="button" class="btn btn-primary pull-left" data-toggle="modal" id="first" data-title="Buscar" data-target="#favoritesModalProduct">
                          <i class="fa fa-search"></i>
                       </button>
                   </div>
                   
                    <div class="col-md-4 pull-left ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                    <div class="col-md-2">
                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" 
                        onkeyup="">
                      </div> 
                                        
                 </div>
                 
              </div>
              <div class="form-group pull-right">
                        {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
              </div>
              </div>
                </div>
              </section><!-- /.content -->
              {!! Form::close() !!}
             </div>
          <!-- /.box-body -->
        </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
  

@include('admin.products.searchCraftProducts')

@endsection

@section('js')
<script>
$('#searchProducts').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchUpdateStockCreate')}}",
    data:{'search':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
})
</script>

<script>
  function SearchLetter($letter){
  $value=$letter;
  console.log($value);
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchCraftProducts')}}",
    data:{'searchL':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  });
  }
</script>

<script >
  function complete($id,$code,$name,$stock){
  

    
     $('#code').val($code);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#favoritesModalProduct').modal('hide');
  };


</script>

@endsection
