<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Productos Vendidos</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>Reporte de Productos Vendidos</h1>
      
    </header>
  <h2>Fecha: {{date('d-m-Y')}}</h2>
  @php ($a = 0)   
  @php ($m = 0) 
  @foreach($data2 as $month)

    <h2>Mes: {{strtoupper(nameMonth($month))}}</h2>
      <main>
       <table>
              <thead>
               <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Importe</th>
                </tr>
                </thead>
                <tbody>

      @foreach($data as $products)
      

       @if ($month == $products->month)
                           <tr>
                            <td class="text-center">{{$products->code}}</td>
                            <td class="text-center">{{$products->name}}</td>
                            <td class="text-center">{{$products->amount}}</td>
                            <td class="text-center">${{$products->total}}</td>
                           </tr>
         @else
         
         @endif
        
        @endforeach
            </tbody>
          </table> 
        @php ($m = $m +1) 
@endforeach
    <footer>
     
    </footer>
    
  </body>
</html>