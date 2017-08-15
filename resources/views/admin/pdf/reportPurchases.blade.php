<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Compras</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>Reporte de Compras</h1>
      
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
                <th>N° Compra</th>
                <th>Proveedor</th>
                <th>Total</th>
                </tr>
                </thead>
                <tbody>

      @foreach($data as $purchase)
      

       @if ($month == date_format($purchase->created_at,'n'))
       @php ($total = $total + $purchase->total)          
     
     

                            <tr>
                            <td class="text-center">{{$purchase->id}}</td>
                            <td class="text-center">{{$purchase->provider->name}}</td>
                            <td class="text-center">${{$purchase->total}}</td>
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