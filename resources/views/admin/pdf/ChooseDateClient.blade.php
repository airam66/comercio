<!--POPUP-->


 <div class="modal fade" id="chooseDateClient" tabindex="-1" 

      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightgreen "><b>Seleccione una fecha</b>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title" id="favoritesModalLabel"> </h4>
      </div>
      <div class="modal-body">

                 <form action='createReportCOrder'  method="GET" target="_blank" >
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha" id="fecha1">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha" id="fecha2">
                  <div class="input-group-addon">
                    
                    <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-calendar"></i>
                      </button>
                  </div>
                </div>
              </div>
         </form>
         
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