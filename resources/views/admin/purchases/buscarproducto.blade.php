<!--POPUP-->


 <div class="modal fade" id="favoritesModalProduct" tabindex="-1" 

      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightgray">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title" id="favoritesModalLabel">BUSCAR PRODUCTOS</h4>
      </div>
      <div class="modal-body">
<div>
    <input type ='button' class="btn btn-warning pull-left"  value = 'Agregar' onclick="location.href = '{{ route('products.create') }}'"/>
  <div class="input-group pull-right" >
 
  <input type="text" name="searchProducts" id="searchProducts" class="form-control"   placeholder="Nombre..."> 
  </div>
      
        
  <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
    <thead>
            <tr>
             <th style="width:10px">Codigo</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Acción</th>
                   
            </tr>
    </thead>
     
       
       
<tbody id="mostrar">
   
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


