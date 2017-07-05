@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nueva Compra</h3>
         </div>
      <div class="box-body">
          {!! Form::open(['route'=>'purchases.store', 'method'=>'POST', 'files'=>true])!!}
          <section>
      
              <div class="border">
                <h3>Proveedor</h3>
                <div class="row ">
                       
                      <div class="col-md-3 pull-left" >
                           {!! form::label('CUIT')!!}
                           <input id="cuit" class="form-control" name="cuit" type="text" >
                       </div>
                       <div class="pull-left">
                       <br>
                            <button type="button" class="btn btn-primary " data-toggle="modal" id="second" data-title="Buscar" data-target="#favoritesModalProvider"><i class="fa fa-search"></i></button>
                            @include('admin.purchases.buscarProvider')
                      </div>
                      <div class="col-md-6  col-md-offset-2">
                            <input id="provider_id" name="provider_id" class="form-control" type="hidden" >
                            {!!Field::text('nombre',null,['disabled'])!!}
                      </div>
                </div>
              </div>

              <div class="panel-body borde"><!--busqueda prorducto-->
                  <h3>Productos</h3>
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
                   
                   <div class="col-md-2 col-md-offset-2">
                       {!!Field::number('price',null, ['step'=>'any'])!!} 
 
                    </div>
                     <div class="col-md-2">
                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" 
                        onkeyup="">
                      </div>                    
                 </div>
                 <div class="row " >
                    <div class="col-md-4 ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                 </div>
              </div>
        
              <div class="row no-print">
                  <div class="col-xs-12">
                      <div class= "form-group">
                      {!! Form::hidden('status','activo',['class'=>'form-control'])!!} 
                      </div>

                      <div class="form-group">
                        {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
                       </div>
                  </div>
                </div>
              </section><!-- /.content -->
              {!! Form::close() !!}
             </div>
 
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>

 @include('admin.purchases.buscarProducto')

@endsection

@section('js')
<script>

  var options={
    url: function(p){
      return baseUrl('admin/autocompleteProvide?p='+p);
         }, getValue:'cuit',
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var client = $('#cuit').getSelectedItemData();
                        $('#nombre').val(client.name);
                        $('#provide_id').val(cleint.id);
                    },
                    onKeyEnterEvent: function () { 
                        var client = $('#cuit').getSelectedItemData();
                        $('#nombre').val(client.name);
                        $('#provide_id').val(client.id);
                    }
                }
   };
  
  $("#cuit").easyAutocomplete(options);


</script>
<script type="text/javascript">
  function completeC($id,$cuit,$name){
    $('#cuit').val($cuit);
    $('#nombre').val($name);
    $('#provider_id').val($id);
    $('#favoritesModalProvider').modal('hide');
  };
</script>
<script >
  function complete($id,$code,$name,$wholesale,$retail,$stock,$amount){
    $('#code').val($code);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#price').val($retail);//por defecto
    $('#favoritesModalProduct').modal('hide');
  };
</script>
<script >
$('#searchP').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchProvider')}}",
    data:{'searchProvider':$value},
    success: function(data){
      $('#mostrarP').html(data);
    }
    
  })
})
</script>
<script>
$('#searchProducts').on('keyup', function(){
  $value=$(this).val();
  $providerid=$('#provider_id').val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchProducts')}}",
    data:{'searchProducts':$value,'provider_id':$providerid},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
})
</script>
@endsection
 

