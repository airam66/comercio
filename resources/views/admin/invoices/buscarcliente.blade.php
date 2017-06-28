<div class="modal fade" id="favoritesModalCliente" tabindex="-1" 
      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightgray">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title" id="favoritesModalLabel">BUSCAR CLIENTES</h4>
      </div>
      <div class="modal-body">
<div>
<button  type="button" class="btn btn-primary" data-toggle="modal" data-id="A" data-title="Buscar" data-target="#favoritesModal"></button>

  <a id="A">A</a>|
  <a href="{{route('SearchLetra',$letra='B')}}">B</a>|
  <a href="{{route('SearchLetra',$letra='C')}}">C</a>|
  <a href="{{route('SearchLetra',$letra='D')}}">D</a>|
  <a href="{{route('SearchLetra',$letra='E')}}">E</a>|
  <a href="{{route('SearchLetra',$letra='F')}}">F</a>|
  <a href="{{route('SearchLetra',$letra='G')}}">G</a>|
  <a href="{{route('SearchLetra',$letra='H')}}">H</a>|
  <a href="{{route('SearchLetra',$letra='I')}}">I</a>|
  <a href="{{route('SearchLetra',$letra='J')}}">J</a>|
  <a href="{{route('SearchLetra',$letra='K')}}">K</a>|
  <a href="{{route('SearchLetra',$letra='L')}}">L</a>|
  <a href="{{route('SearchLetra',$letra='M')}}">M</a>|
  <a href="{{route('SearchLetra',$letra='N')}}">N</a>|
  <a href="{{route('SearchLetra',$letra='O')}}">O</a>|
  <a href="{{route('SearchLetra',$letra='P')}}">P</a>|
  <a href="{{route('SearchLetra',$letra='Q')}}">Q</a>|
  <a href="{{route('SearchLetra',$letra='R')}}">R</a>|
  <a href="{{route('SearchLetra',$letra='S')}}">S</a>|
  <a href="{{route('SearchLetra',$letra='T')}}">T</a>|
  <a href="{{route('SearchLetra',$letra='U')}}">U</a>|
  <a href="{{route('SearchLetra',$letra='V')}}">V</a>|
  <a href="{{route('SearchLetra',$letra='W')}}">W</a>|
  <a href="{{route('SearchLetra',$letra='X')}}">X</a>|
  <a href="{{route('SearchLetra',$letra='Y')}}">Y</a>|
  <a href="{{route('SearchLetra',$letra='Z')}}">Z</a>|
  <a href="{{route('buscarproducto')}}">TODOS</a>

        
        <form route='admin.invoices.buscarproducto'  method="GET" class="col-md-3 col-md-offset-1 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn"  data-target="#favoritesModal"class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        
        <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
             <th style="width:10px">Codigo</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Línea</th>
                <th>Imagen</th> 
                <th>Acción</th>
                   
            </tr>
        </thead>
     
       
       
<tbody>
   @foreach($products as $product) 
        <tr>
            <td class="sorting_1">{{$product->code}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->category->name}}</td>   
            
            <td>{{$product->line->name}}</td>
                        <td> 
            @if($product->extension!=null)
                    <div>
                    <img src="{{ asset('images/products/'.$product->extension)  }}" width="40" height="40" >
                    </div>
            @endif
            </td>        
            <td><a onclick="complete({{$product->id}},'{{$product->code}}','{{$product->name}}',{{$product->wholesale_price}},{{$product->retail_price}},{{$product->stock}},{{$product->wholesale_cant}})" type="button" class="btn btn-primary"> Agregar </a></td>
           
        </tr>
  @endforeach
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