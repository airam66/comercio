<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pedido</title>
    <link rel="shortcut icon" type="image/x-ico" href="{{ asset('images/logoss.ico')}}">
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
   
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
       
        <img src="{{ asset('images/cotillon.png ') }}">
        <address>
              <strong>CUIT: 38335256729</strong><br>
              Direccion:Roque Saenz Peña Nro 14 bis 2 B° San Martin,Rosario de Lerma, Salta<br>
              Telefono: (387)59662005 - (387) 5910201<br>
              Email:creatucotillon@gmail.com
            </address>
      </div>
      
    </header>    
         
     <main>
      <div class="message">
        <p><b>  Comprobante no válido como factura. Si dentro de los 6 días de realizar el pedido no paga un adelanto, el mismo será cancelado.</b></p>
      </div>
      <div class="client">
       <p class="name"><b>Fecha de pedido: {{$shoppingCart->created_at->format('d-m-y')}}</b></p>
       <p class="name"><b>Nombre:</b> {{$shoppingCart->client->name}}  <b>--   CUIT/CUIL:</b> {{$shoppingCart->client->cuil}} <b>--   Telefono: {{$shoppingCart->client->phone}}</b></p>
       <p class="name"> <b>Dirección:</b> {{$shoppingCart->client->address}} 
       <b>   --Localidad:</b> {{$shoppingCart->client->location}} 
       </p>
      </div>
             <table>
              <thead>
               <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                </tr>
                </thead> 

                 <tbody>
                 
                     @foreach($details as $detail)
                 
                            <tr>
                            <td class="text-center">{{$detail->product_name}}</td>
                            <td class="text-center">${{$detail->price}}</td>
                            <td class="text-center">{{$detail->amount}}</td>
                            <td class="text-center">${{$detail->subTotal}}</td>
                            </tr>
                    

                     @endforeach 
         
                </tbody>

             </table> 
             <div class="pull-right">
            
               <h3>TOTAL: ${{$shoppingCart->total}}</h3>
          

            </main>
           

    <footer>
    
    </footer>
    
  </body>
</html>