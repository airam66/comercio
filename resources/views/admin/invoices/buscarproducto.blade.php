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
<button  type="button" class="btn btn-primary" data-toggle="modal" data-id="A" data-title="Buscar" data-target="#favoritesModal"></button>


  <a id="A">A</a>|

  <a href="">B</a>|
  
  <a href="">W</a>|
  <a href="">X</a>|
  <a href="">Y</a>|
  <a href="">Z</a>|
  <a href="{{route('buscarproducto')}}">TODOS</a>

        
        
            <div class="input-group">
              <input type="text" name="search" id="search" class="form-control"   placeholder="Nombre..."> 
              
                
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
        <span class="pull-right">
          <button type="button" class="btn btn-primary">
            AGREGAR
          </button>
        </span>
      </div>
    </div>
  </div>
</div>
<!--FIN POPUP-->


