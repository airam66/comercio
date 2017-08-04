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
      <div class="client">
       <p class="name"><b>Cliente:</b> {{$order->client->name}}  <b>--   CUIT/CUIL:</b> {{$order->client->cuil}}</p>
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
               <h3>Total: ${{$order->total}}</h3>
             </div>
            </main>
           

    <footer>
    
    </footer>
    
  </body>
</html>