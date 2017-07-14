@extends('layouts.main')

@section('content')

<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Actualizar stock de productos personalizados</h3>
         </div>
        <div class="box-body">
          {!! Form::open(['route'=>'products.updateStock', 'method'=>'POST'])!!}
          <section>
              <div class="panel-body borde"><!--busqueda producto-->
                <h3>Producto</h3>
                <div class="row " >
                    <div class="col-md-3 pull-left" >
                         {!!Field::text('code')!!}
                                                  
                    </div> 
                    <div class="pull-left">
                    <br>
                       <button id="iconSearch" type="button" class="btn btn-primary pull-left" data-toggle="modal" id="first" data-title="Buscar" data-target="#favoritesModalProduct">
                          <i class="fa fa-search"></i>
                       </button>
                   </div>
              
                   <div class="col-md-2 col-md-offset-2">
                        {!! Field::number('amount')!!}
                        
                    </div>                    
                </div>

                 <div class="row " >
                    <div class="col-md-4 pull-left ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                     
                    <div class="col-md-4  col-md-offset-1 ">
                         {!!Field::text('stock',null,['disabled'])!!}
                    </div>

                 </div>

                  <div class="form-group">
                   <input type="hidden" name="id" id="id">
                 </div>

                 <div class="form-group">
                   {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
                 </div>
             </div>
              
              </section>
              {!! Form::close() !!}
            </div>
 
          </div>
        </div>
      </div>
    </div>
@include('admin.products.searchCraftProducts')

@endsection

@section('js')
<script>
$('#search').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchCraft')}}",
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
  function complete($id,$code,$name,$wholesale,$retail,$stock){
    var am=0;

    $('#stock').val($stock);
     $('#code').val($code);
    $('#id').val($id);
    $('#name').val($name);
    $('#favoritesModalProduct').modal('hide');
  };


</script>

@endsection