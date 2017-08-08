<!--POPUP-->


 <div class="modal fade" id="favoritesModalProduct{{$product->id}}" tabindex="-1" 

      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:pink"><b>{{strtoupper($product->name)}}</b>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title" id="favoritesModalLabel"> </h4>
      </div>
      <div class="modal-body">
         <div>
      
             <img style="float:left; margin-right:10px;" src="{{ asset('images/products/'.$product->extension)  }}" width="240" height="240"/>
      

       
              <p>
                <h5><strong>Código: </strong>{{$product->code}}</h5>
                <h5><strong>Línea: </strong>{{$product->line->name}}</h5>
                <h5><strong>Evento/s: </strong> --
                  @foreach($productEvent as $event)
                    
                    @if($event->product_id == $product->id)
                       {{$event->event_name}} --          
                      
                   @endif
                  @endforeach
                </h5>
                <h5><strong>Precio Compra: </strong>${{$product->purchase_price}}</h5>
                <h5><strong>Precio Mayorista: </strong>${{$product->wholesale_price}}</h5>
                <h5><strong>Precio Minorista: </strong>${{$product->retail_price}}</h5>
                <h5><strong>Cantidad Mayorista: </strong>{{$product->wholesale_cant}}</h5>
                <br>
                <br>
                <br>
                <h5><strong>Descripción: </strong>{{$product->description}}</h5>
              </p>

          </div><!--FIN DEL BODY-->
           
      </div>

      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">SALIR</button>
      </div>
    
  </div>
</div>
</div>
<!--FIN POPUP-->