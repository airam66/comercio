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
             @if ($order->discount!=0)
               <h3>Con descuento del {{$order->discount}}% -TOTAL: ${{$order->total}}</h3>
              @else
               <h3>TOTAL: ${{$order->total}}</h3>
             @endif
             </div>

             <div class="text-center" style="background-color: orange; width: 50%;">
                        <h3 style="color:black;">PAGOS</h3>
             </div>
             
             <div>
             <div class="col-xs pull-left">
             <table>
                <tr>
                   <th>Fecha</th>
                   <th>Monto pagado</th>
                   <th>Saldo a pagar</th>
                </tr>

                <tbody>
                   @foreach($payments as $payment)
                     <tr>
                       <td class="text-center">{{$payment->created_at->format('d/m/Y')}}</td>
                       <td class="text-center">${{$payment->amount_paid}}</td>
                       <td class="text-center">${{$payment->balance_paid}}</td>
                     </tr>

                   @endforeach
                   @if((count($payments)==1) && ($order->client->bill != 0))
                   
                   <tr>
                       <td class="text-center" height="10"></td>
                       <td class="text-center"></td>
                       <td class="text-center"></td>
                     </tr>
                    <tr>
                       <td class="text-center" height="10"></td>
                       <td class="text-center"></td>
                       <td class="text-center"></td>
                     </tr>
                      <tr>
                       <td class="text-center" height="10"></td>
                       <td class="text-center"></td>
                       <td class="text-center"></td>
                     </tr>
                      <tr>
                       <td class="text-center" height="10"></td>
                       <td class="text-center"></td>
                       <td class="text-center"></td>
                     </tr>
                  
                    @endif

                </tbody>

             </table> 
           </div>
            @if ($order->client->bill == 0)
            <div>
            <img src="{{ asset('images/pagado.png ') }}" width="160px"  height="140px" class="payment">
            </div>
            @else

            @endif
          
            </div>

            </main>
           

    <footer>
    
    </footer>
    
  </body>
</html>