<!--POPUP-->


 <div class="modal fade" id="favoritesModalProduct" tabindex="-1" 

      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightblue">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             X
             </button>
             <h4 class="modal-title" id="favoritesModalLabel"><b>BUSCAR PRODUCTOS</b></h4>
      </div>
      <div class="modal-body">
<div>
 @include('partials.letter')


  <div class="input-group pull-right" >
  <input type="text" name="search" id="search" class="form-control"   placeholder="Nombre..."> 
  </div>
    <br>
    <br>
    <br>  
        
  <table id="tabla" class="display table table-hover" cellspacing="0" width="100%">
       
    <thead>
            <tr style="background-color:lightgray">
                
                <th>Nombre</th>
                <th>Precio Mayorista</th>
                <th>Precio Minorista</th>
                <th>Stock</th>
                <th></th>
                   
            </tr>
    </thead>
     
       
       
<tbody id="mostrar">

@foreach($products as $product)
 <tr>
         
            <td>{{$product->name}}</td>
            <td>${{$product->retail_price}}</td>
            <td>${{$product->wholesale_price}}</td>   
            <td>{{$product->stock}}</td>
            <td><a onclick="complete({{$product->id}},'{{$product->code}}','{{$product->name}}',{{$product->wholesale_price}},{{$product->retail_price}},{{$product->stock}})" type="button" class="btn btn-primary"> Agregar </a></td>

            

            </tr>
@endforeach

   
</tbody>
   
    </table>

      </div><!--FIN DEL BODY-->
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">SALIR</button>
      </div>
    </div>
  </div>
</div>
<!--FIN POPUP-->
