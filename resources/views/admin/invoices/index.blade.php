@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
  <div class="row">
      <h2 class="box-title col-md-5">Listado de Ventas</h2>
  </div>
      <div class="row">
        <div class='col-sm-2 pull-right'>
          <input type ='button' class="btn btn-success "  value = 'Agregar' onclick="location.href = '{{ route('invoices.create') }}'"/> 
        </div>
        <br>
        <div class='col-sm-6 pull-left'>
            <form route='invoices.index'  method="GET">
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
 @if($invoices->isNotEmpty())
 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th class="text-center">N° Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody id="mostrar">
   @foreach ($invoices as $key => $invoice) 
         
                @if ($invoice->status!='inactivo')
                   <tr role="row" class="odd">
                
                @else
                  <tr role="row" class="odd" style="background-color: rgb(255,96,96)">
                
                @endif
                 
                        <td class="text-center">{{$invoice->id}}</td>
                        <td>{{$invoice->created_at->format('d/m/Y')}}</td>
                        <td>{{$invoice->client->name}}</td>
                        <td>${{$invoice->total}}</td>
                        <td>
                         

                        <a href="{{route('invoices.show',$invoice->id)}}" > <button  type="button" class="btn btn-info "  >
                        <span class="fa fa-list" aria-hidden="true" ></span></button></a>

                          @if ($invoice->status!='inactivo')
                             <a href="{{route('invoices.desable',$invoice->id)}}" onclick="return confirm('¿Seguro dara de baja el producto?')">
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>

                     <a href="{{route('invoices.pdf',$invoice->id)}}" target="_blank" > <button  type="button" class="btn btn-primary "  ><i class="fa fa-print"></i> 
                      </button></a>
                       @endif     
        </tr>
        @endforeach

     </tbody>
    </table>
    <div class="text-center">
         {!!$invoices->render()!!}
    </div>

 @else
        <div class="alert alert-dismissable alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>No se encontró ninguna venta entre {{$fecha1}} y {{$fecha2}}.</p>
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
function myDetail(id){
dir=baseUrl('admin/invoices/'+id);
window.location.replace(dir); 
             
} 


</script>
<script type="text/javascript">
function myDelete(id){
  $.ajax({

type: "POST",
url: "{{ URL::to('invoices/desable')}}",
data: { id: id }
});

}
</script>

@endsection