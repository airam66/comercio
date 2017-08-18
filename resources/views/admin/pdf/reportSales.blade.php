<!DOCTYPE html>
<html lang="es">
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
      <h1>Reporte de Ventas</h1>
      
    </header>
      
  @php ($a = 0)   
  @php ($m = 0) 
  @foreach($data2 as $month)

    <h2>Mes: {{strtoupper(nameMonth($month))}}</h2>
        @php ($total = 0.0)
      <main>
       <table>
              <thead>
               <tr>
                <th>N° Venta</th>
                <th>Cliente</th>
                <th>Total</th>
                </tr>
                </thead>
                <tbody>

      @foreach($data as $sale)
      

       @if ($month == date_format($sale->created_at,'n'))
       @php ($total = $total + $sale->total)          
     
     

                            <tr>
                            <td class="text-center">{{$sale->id}}</td>
                            <td class="text-center">{{$sale->client->name}}</td>
                            <td class="text-center">${{$sale->total}}</td>
                            </tr>
         @else
         
         @endif
        
        @endforeach
            </tbody>
          </table> 
        @php ($m = $m +1) 
        <div class="pull-right" >
                 <h3>Total del Mes: ${{$total}} </h3>
              </div>

@endforeach
    <footer>
     
    </footer>
    
  </body>
</html>