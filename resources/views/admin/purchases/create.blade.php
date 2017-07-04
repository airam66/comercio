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
                      <div class="col-md-6  pull-right">
                            <input id="provider_id" name="provider_id" class="form-control" type="hidden" >
                            {!!Field::text('nombre',null,['disabled'])!!}
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

  var options={
    url: function(p){
      return baseUrl('admin/autocompleteClient?p='+p);
         }, getValue:'cuil',
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var client = $('#cuil').getSelectedItemData();
                        $('#nombre').val(client.name);
                        $('#client_id').val(cleint.id);
                    },
                    onKeyEnterEvent: function () { 
                        var client = $('#cuil').getSelectedItemData();
                        $('#nombre').val(client.name);
                        $('#client_id').val(client.id);
                    }
                }
   };
  
  $("#cuil").easyAutocomplete(options);


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
@endsection
 

