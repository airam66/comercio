<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Orden de Compra</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>Orden de compra N° {{$purchase->id}}</h1>
      
    </header>
      
      <h2>Proveedor: {{$purchase->provider->name}} </h2>
  
      <p><h4>Dirección: {{$purchase->provider->address}} -- Localidad: {{$purchase->provider->location}}  --   Provincia: {{$purchase->provider->province}} -- Teléfono: {{$purchase->provider->phone}}</h4></p>
       
         
            <main>
             <table>
              <thead>
               <tr>
                <th>Productos</th>
                <th>Marca</th>
                <th>Precio de Compra</th>
                <th>Cantidad</th>
                <th>Subtotal Estimado</th>
                </tr>
                </thead> 

                 <tbody>
                 
                     @foreach($details as $detail)
                 
                            <tr>
                            <td class="text-center">{{$detail->product_name}}</td>
                            <td class="text-center">{{$detail->brand_name}}</td>
                            <td class="text-center">{{$detail->price}}</td>
                            <td class="text-center">{{$detail->amount}}</td>
                            <td class="text-center">{{$detail->subTotal}}</td>
                            </tr>
                    

                     @endforeach 
         
                </tbody>

             </table> 
            </main>
           

    <footer>
    
    </footer>
    
  </body>
</html>