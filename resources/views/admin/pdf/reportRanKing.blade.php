<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte Ran King</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>LISTADO DE PRODUCTOS MÁS VENDIDOS</h1>
      Fecha de emisió: {{date('d').'/'.date('m').'/'.date('Y')}}
      
    </header>        
         
            <main>
             <table>
              <thead>
               <tr>
                <th>Codigo</th>
                <th>Descripción</th>
                <th>Catidad</th>
                <th>Importe</th>
                </tr>
                </thead> 
                 <tbody>
                 
                    @foreach($data as $product)
                         <tr>
                            <td class="text-center">{{$product->code}}</td>
                            <td class="text-center">{{$product->name}}</td>
                            <td class="text-center">{{$product->cant}}</td>
                            <td class="text-center">{{$product->price}}</td>
                          </tr>

                     @endforeach 
         
                </tbody>

             </table> 
            </main>
            

    <footer>
     
    </footer>
    
  </body>
</html>