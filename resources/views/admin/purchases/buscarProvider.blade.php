<div class="modal fade" id="favoritesModalProvider" tabindex="-1" role="dialog" aria-labelledby="favoritesModalProviderLabel">

  <div  class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightgray">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title" id="myfavoritesModalProviderLabel">BUSCAR PROVEEDOR</h4>
      </div>
      <div class="modal-body">
          <div>
              <div class="input-group pull-right" >
                  <input type="text" name="searchP" id="searchP" class="form-control"   placeholder="Nombre..."> 
              </div>
      
        
                <table id="tablaclient" class="display table table-hover" cellspacing="0" width="100%">
                     
                  <thead>
                          <tr>
                           <th style="width:10px">Cuit</th>
                              <th>Nombre</th>
                              <th>Dirección</th>
                              <th>Telefono</th>
                              <th>Email</th>
                              <th></th>
                          </tr>
                  </thead>
                                        
              <tbody id="mostrarP">
                 
              </tbody>
                 
                  </table>

      </div><!--FIN DEL BODY-->
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-defaultp" 
           data-dismiss="modal">SALIR</button>
      </div>
    </div>
  </div>
</div>
</div>
<!--FIN POPUP-->


