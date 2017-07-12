@extends('layouts.main')
 
 
@section('content')
   
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Cargar productos de un proveedor</h3>
         </div>
          {!! Form::open(['route'=>'providersproducts.store', 'method'=>'POST', 'files'=>true])!!}
          <div class="box-body">
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
                            @include('admin.providersproducts.buscarProvider')
                      </div>
                      <div class="col-md-6  col-md-offset-1">
                            <input id="provider_id" name="provider_id" class="form-control" type="hidden" >
                            {!!Field::text('nombre',null,['disabled'])!!}
                      </div>
                </div>
                </div>
<!-- busqueda de productos-->
                <div class="row " >
                <h3>Productos</h3>
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
                   <div class="col-md-6 col-md-offset-1">
                         {!!Field::text('name',null,['disabled'])!!}
                   </div>
                   <div class="col-md-1">
                      <button type="button" id="btn_add" class="btn btn-primary pull-right" onclick="add_product()">Agregar
                      </button>
                    </div>
                    
                 </div>
        
                 <div class="col-xs-12 table-responsive">
                    <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <tr>
                          <th>Eliminar</th>
                          <th>Codigo</th>
                          <th>Nombre</th>
                        </tr>
                      </thead>

                      <tbody>
                         
                      </tbody>

                    </table>
                  </div>
              <div class="row no-print">
                  <div class="col-xs-12">


                      <div class="form-group">
                        {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
                      </div>
                  </div>
                </div>


              </section>

             </div>
 
              {!! Form::close() !!}

          </div>
   
        </div>
    </div>
</div>
@include('admin.providersproducts.buscarProducto')

@endsection

@section('js')
<script>

  var options={
    url: function(p){
      return baseUrl('admin/autocompleteProvider?p='+p);
         }, getValue:'cuit',
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 

                        var provider = $('#cuit').getSelectedItemData();

                        $('#nombre').val(provider.name);
                        $('#provider_id').val(provider.id);
                    },
                    onKeyEnterEvent: function () { 

                        var provider = $('#cuit').getSelectedItemData();

                        $('#nombre').val(provider.name);
                        $('#provider_id').val(provider.id);
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

<script type="text/javascript">
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
$('#search').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/search')}}",
    data:{'search':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
})
</script>
<script >
  function complete($id,$code,$name,$wholesale,$retail,$stock,$amount){
    $('#code').val($code);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#favoritesModalProduct').modal('hide');
  };
</script>
<script>
  var cont=0;
  function add_product(){
    code=$('#code').val();
    product_id=$('#product_id').val();
    name=$('#name').val();
    
  if (product_id!="" && code!="" && name!=""){

          var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="deletefila('+cont+');">X</button></td> <td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+code+'</td> <td>'+name+'</td> > </tr>';
          cont++;
          clear();
        $('#details').append(fila);

  }else{
        alert("Error al algregar producto, revise que posea datos");
  }
}

function deletefila(index){
  $('#fila'+index).remove();
 }

 function clear(){
    $('#code').val('');
    $('#product_id').val('');
    $('#name').val('');
 }
</script>
@endsection
 

