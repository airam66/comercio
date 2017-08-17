<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de stock</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>LISTADO DE PRODUCTOS CON BAJO STOCK</h1>
      
    </header>
      

      @foreach($data2 as $provider)

         <h2>Proveedor: {{$provider->name}}</h2>
        
         
            <main>
             <table>
              <thead>
               <tr>
                <th>Productos</th>
                <th>Marca</th>
                <th>Stock</th>
                </tr>
                </thead> 
                 <tbody>
                 
                    @foreach($data as $product)

                        @if($provider->provider_id == $product->provider_id)
                  
                            <tr>
                            <td class="text-center">{{$product->product_name}}</td>
                            <td class="text-center">{{$product->brand_name}}</td>
                            <td class="text-center">{{$product->stock}}</td>
                            </tr>
                        @endif

                     @endforeach 
         
                </tbody>

             </table> 
            </main>
      @endforeach
            

    <footer>
     
    </footer>
    
  </body>
</html>