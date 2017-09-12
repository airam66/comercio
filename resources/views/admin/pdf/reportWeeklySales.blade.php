<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Productos Vendidos Semanalmente</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>Reporte de Productos Vendidos Semanalmente</h1>
      
    </header>
<h3>Fecha de emisión: {{date('d-m-Y')}}</h3>
<h3>
  Semana: {{$d}} de {{strtoupper(nameMonth($m))}} de {{$y}}
</h3>
 @php ($total = 0.0)
 

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

                 @foreach($products as $product)
                   @php ($total = $total + $product->total)  
                             <tr>
                              <td class="text-center">{{$product->code}}</td>
                              <td class="text-center">{{$product->name}}</td>
                              <td class="text-center">{{$product->amount}}</td>
                              <td class="text-center">${{$product->total}}</td>
                            </tr>
   
                  @endforeach
              </tbody>
          </table> 
       
     <div class="pull-right" >
                 <h3>Total de semana: ${{$total}} </h3>
              </div>
    <footer>
     
    </footer>
    
  </body>
</html>