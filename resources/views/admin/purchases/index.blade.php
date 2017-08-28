@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
    <div class="row">
        <h2 class="box-title col-md-5">Listado de Órdenes de Compras</h2>
    </div>

      <div class="row"> 
      <div class='col-sm-2 pull-right'>
        <input type ='button' class="btn btn-success"   value = 'Agregar' onclick="location.href = '{{ route('purchases.create') }}'"/> 
        </div>
        <br>
        <div class='col-sm-6 pull-left'>
           <form route='purchases.index'  method="GET">
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">
                        <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-calendar"></i>
                                  </button>
                  </div>
                </div>
              </div>

            </form>
        </div>
        </div>
      </div>



<div class="box-body">    
 @if($purchases->isNotEmpty())          

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th>N° Orden Compra</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th></th>

                 
            </tr>
        </thead>
     
       
<tbody id="mostrar">
   @foreach ($purchases as $key => $purchase) 
         
                @if ($purchase->status!='rechazada' )
                  
                <tr>
                              
                        <td>{{$purchase->id}}</td>
                        <td>{{$purchase->created_at->format('d/m/Y')}}</td>
                        <td>{{$purchase->provider->name}}</td>
                        <td>{{$purchase->status}}</td>
                        <td>

                       <a href="{{route('purchases.detailPurchaseOrder',$purchase->id)}}" > <button  type="button" class="btn btn-info "  ><span class="fa fa-list" aria-hidden="true" ></span></button></a>
                       
                       <a href="{{route('purchases.show',$purchase->id)}}" target="_blank" > <button  type="button" class="btn btn-primary "  ><i class="fa fa-print"></i> 
                       </button></a>
                         
                         <a href="{{route('purchasesInvoice.loadOrder',$purchase->id)}}"  >
                                <button type="submit" class="btn btn-primary">
                                    Registrar Compra
                            
                                </button>
                        </a>

                        
                             <a href="{{route('purchases.desable',$purchase->id)}}" onclick="return confirm('¿Seguro dara de baja el producto?')">
                        <button type="submit" class="btn btn-danger" name="delete">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
                        
  

                        <a href="{{route('purchases.edit',$purchase->id)}}"  >
                                <button type="submit" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                                </button>
                        </a>


                         
                  </td>
                  </tr>

                    @endif
                         
        @endforeach

       </tbody>
    </table>
    <div class="text-center">
         {!!$purchases->render()!!}
    </div>

 @else
        <div class="alert alert-dismissable alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>No se encontró ninguna orden entre {{$fecha1}} y {{$fecha2}}.</p>
        </div>

  @endif


</div>

</div>
@endsection
@section('js')
 <script type="text/javascript">

$('.input-daterange input').each(function() {
    $(this).datepicker({
         language: "es",
         autoclose: true,
         format:"yyyy/mm/dd"
    });
});


</script>

<script type="text/javascript">
function myDelete(id){
  $.ajax({

type: "POST",
url: "{{ URL::to('admin/purchases/desable')}}",
data: { id: id }
});

}
</script>



@endsection