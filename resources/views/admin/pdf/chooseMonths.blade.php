<!--POPUP-->


 <div class="modal fade" id="chooseMonths" tabindex="-1" 

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
         
            <!-- form busqueda -->
                      <form action={{$date}}  method="GET" target="_blank">
                            
                      
                      <div class="col-md-5 pull-left">
                          {!! Field::select('from_number', $months, ['empty'=>'Seleccione un mes'])!!}
                       </div>
                       <div class="col-md-5">

                           {!! Field::select('to_number', $months, ['empty'=>'Seleccione un mes'])!!}   
                        </div>                           
                        <br>

                        
                      <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-calendar"></i>
                      </button>
                       
                   
                          
                      </form> 
                      <br>
                      <br>
                     <!-- /form  busqueda-->
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