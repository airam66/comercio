<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>LISTADO DE CLIENTES</h1>
      
    </header>

      @foreach($data2 as $client)


             <div class="provider">
           <p class="name"><b>Cliente:</b>  {{$client->name}}<b>--   Telefono: {{$client->phone}}</b> <b>--Direccion:</b> {{$client->address}} </p>
            </div>
         
        
         
            <main>
             <table>
              <thead>
               <tr>
                <th>Pedido</th>
                <th>Entrega</th>
                <th>Total</th>
                <th>Saldo</th>
                </tr>
                </thead> 
                 <tbody>
                 
                    @foreach($data as $invoice)

                      
                         @if($client->client_id == $invoice->client_id)
                            <tr>
                            <td class="text-center">{{$invoice->id}}</td>
                            <td class="text-center">{{$invoice->delivery_date}}</td>
                            <td class="text-center">${{$invoice->total}}</td>
                            <td class="text-center">${{$client->bill}}</td>
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