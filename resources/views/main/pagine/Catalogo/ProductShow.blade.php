<!--POPUP-->


 <div class="modal fade" id="favoritesModalProduct{{$product->id}}" tabindex="-1"  role="dialog" aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
<!--div class="modal-content"-->
<div class="modal-body">
<div class="content-wrap centering">
      <div class="card product-show text-left" >   
          <h1> {{$product->name}} 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
          </h1>
          <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <img src="{{ asset('images/products/'.$product->extension)  }}" width="300" height="300">
                </div>
                <div class="col-sm-6 col-xs-12 text-center">
                    <p >
                      <strong>Descripción</strong>
                    </p>
                    <p >
                      {{$product->description}}
                    </p>
                    <p>
                      <b> Marca:  </b>{{$product->brand->name}}
                    </p>
                </div>
          </div>
      </div>
</div>    
</div>
      <!--botton salir -->
<!--/div-->
</div>
</div>
<!--FIN POPUP-->