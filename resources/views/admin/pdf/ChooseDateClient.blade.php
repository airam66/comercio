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

      <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                     
                     <input type="text" id="daterange"  name="daterange" class="form-control" value="12/06/2017 - 16/07/2017" >          
                     <span class="input-group-addon">
                        <a href="#"> <span  class="glyphicon glyphicon-calendar"></span>
                       </span></a>


                </div>
            </div>

         
      </div><!--FIN DEL BODY-->
     
     

      <div class="modal-footer">
        <a href="{{route('pdfClientReport', [$startDate, $endDate])}}" target="_blank" >
        <button type="button" 
           class="btn btn-primary" 
          >ACEPTAR</button></a>
           <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">SALIR</button>
        
      </div>
    
  </div>
</div>
</div>
<!--FIN POPUP-->