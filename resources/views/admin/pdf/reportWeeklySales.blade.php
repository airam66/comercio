<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Ventas Semanales</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>Reporte de Ventas Semanales</h1>
      
    </header>
<h3>
  Semana: {{$d}} de {{strtoupper(nameMonth($m))}} de {{$y}}
</h3>
 
 

      <main>
       <table>
              <thead>
               <tr>
                <th>N° Venta</th>
                <th>Total</th>
                </tr>
                </thead>
                <tbody>

    @foreach($invoices as $invoice)
    
                             <tr>
                            <td class="text-center">{{$invoice->id}}</td>
                            <td class="text-center">${{$invoice->total}}</td>
                            </tr>
   
        @endforeach
            </tbody>
          </table> 
       

    <footer>
     
    </footer>
    
  </body>
</html>