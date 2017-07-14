<!--POPUP-->


 <div class="modal fade" id="favoritesModalProduct" tabindex="-1" 

      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:lightblue">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             X
             </button>
             <h4 class="modal-title" id="favoritesModalLabel"><b>BUSCAR PRODUCTOS</b></h4>
      </div>
      <div class="modal-body">
<div>
  <a class="btn"  id ="searchA" onclick="$('#searchA').val('A'),SearchLetter($('#searchA').val());">A</a> |
  <a class="btn" id ="searchB"  onclick="$('#searchB').val('B'),SearchLetter($('#searchB').val());">B</a>|
  <a class="btn" id ="searchC"  onclick="$('#searchC').val('C'),SearchLetter($('#searchC').val())">C</a>|
  <a class="btn" id ="searchD"  onclick="$('#searchD').val('D'),SearchLetter($('#searchD').val())">D</a>|
  <a class="btn" id ="searchE"  onclick="$('#searchE').val('E'),SearchLetter($('#searchE').val())">E</a>|
  <a class="btn" id ="searchF"  onclick="$('#searchF').val('F'),SearchLetter($('#searchF').val())">F</a>|
  <a class="btn" id ="searchG"  onclick="$('#searchG').val('G'),SearchLetter($('#searchG').val())">G</a>|
  <a class="btn" id ="searchH"  onclick="$('#searchH').val('H'),SearchLetter($('#searchH').val())">H</a>|
  <a class="btn" id ="searchI"  onclick="$('#searchI').val('I'),SearchLetter($('#searchI').val())">I</a>|
  <a class="btn" id ="searchJ"  onclick="$('#searchJ').val('J'),SearchLetter($('#searchJ').val())">J</a>|
  <a class="btn" id ="searchK"  onclick="$('#searchK').val('K'),SearchLetter($('#searchK').val())">K</a>|
  <a class="btn" id ="searchL"  onclick="$('#searchL').val('L'),SearchLetter($('#searchL').val())">L</a>|
  <a class="btn" id ="searchM"  onclick="$('#searchM').val('M'),SearchLetter($('#searchM').val())">M</a>|
  <a class="btn" id ="searchN"  onclick="$('#searchN').val('N'),SearchLetter($('#searchN').val())">N</a>|
  <a class="btn" id ="searchO"  onclick="$('#searchO').val('O'),SearchLetter($('#searchO').val())">O</a>|
  <a class="btn" id ="searchP"  onclick="$('#searchP').val('P'),SearchLetter($('#searchP').val())">P</a>|
  <a class="btn" id ="searchQ"  onclick="$('#searchQ').val('Q'),SearchLetter($('#searchQ').val())">Q</a>|
  <a class="btn" id ="searchR"  onclick="$('#searchR').val('R'),SearchLetter($('#searchR').val())">R</a>|
  <a class="btn" id ="searchS"  onclick="$('#searchS').val('S'),SearchLetter($('#searchS').val())">S</a>|
  <a class="btn" id ="searchT"  onclick="$('#searchT').val('T'),SearchLetter($('#searchT').val())">T</a>|
  <a class="btn" id ="searchU"  onclick="$('#searchU').val('U'),SearchLetter($('#searchU').val())">U</a>|
  <a class="btn" id ="searchV"  onclick="$('#searchV').val('V'),SearchLetter($('#searchV').val())">V</a>|
  <a class="btn" id ="searchW"  onclick="$('#searchW').val('W'),SearchLetter($('#searchW').val())">W</a>|
  <a class="btn" id ="searchX"  onclick="$('#searchX').val('X'),SearchLetter($('#searchX').val())">X</a>|
  <a class="btn" id ="searchY"  onclick="$('#searchY').val('Y'),SearchLetter($('#searchY').val())">Y</a>|
  <a class="btn" id ="searchZ"  onclick="$('#searchZ').val('Z'),SearchLetter($('#searchZ').val())">Z</a>|
  <a class="btn" id ="searchTD"  onclick="$('#searchTD').val(''),SearchLetter($('#searchTD').val())">TODOS</a>


  <div class="input-group pull-right" >
  <input type="text" name="search" id="search" class="form-control"   placeholder="Nombre..."> 
  </div>
    <br>
    <br>
    <br>  
        
  <table id="tabla" class="display table table-hover" cellspacing="0" width="100%">
       
    <thead>
            <tr style="background-color:lightgray">
                
                <th>Nombre</th>
                <th>Precio Mayorista</th>
                <th>Precio Minorista</th>
                <th>Stock</th>
                <th></th>
                   
            </tr>
    </thead>
     
       
       
<tbody id="mostrar">

@foreach($products as $product)
 <tr>
         
            <td>{{$product->name}}</td>
            <td>{{$product->retail_price}}</td>
            <td>{{$product->wholesale_price}}</td>   
            <td>{{$product->stock}}</td>
            <td><a onclick="complete({{$product->id}},'{{$product->code}}','{{$product->name}}',{{$product->wholesale_price}},{{$product->retail_price}},{{$product->stock}})" type="button" class="btn btn-primary"> Agregar </a></td>

            

            </tr>
@endforeach

   
</tbody>
   
    </table>

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
