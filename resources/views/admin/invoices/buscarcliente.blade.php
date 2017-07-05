<div class="modal fade" id="favoritesModalClient" tabindex="-1" role="dialog" aria-labelledby="favoritesModalClientLabel">

  <div  class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightgray">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title" id="myfavoritesModalClientLabel">BUSCAR CLIENTE</h4>
      </div>
      <div class="modal-body">
          <div>
              <div class="input-group pull-right" >
                  <input type="text" name="searchC" id="searchC" class="form-control"   placeholder="Nombre..."> 
              </div>
      
        
                <table id="tablaclient" class="display table table-hover" cellspacing="0" width="100%">
                     
                  <thead>
                          <tr>
                           <th style="width:10px">Cuit</th>
                              <th>Nombre</th>
                              <th>Dirección</th>
                              <th>Telefono</th>
                              <th>Email</th>
                                 
                          </tr>
                  </thead>
                                        
              <tbody id="mostrarC">
                 
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


