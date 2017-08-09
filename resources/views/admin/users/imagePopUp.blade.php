<!--POPUP-->


 <div class="modal fade" id="favoritesModalUserImage{{$user->id}}" tabindex="-1" 

      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modal-sm" id="mdialTamanio" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightgray">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             <h2 class="modal-title" id="favoritesModalLabel">{{$user->name}}</h2>
      </div>
      <div class="modal-body text-center">

        <img src="{{ asset('images/users/'.$user->name_photo)  }}" width="250" height="250">
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
