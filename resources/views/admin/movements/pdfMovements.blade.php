<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Movimientos</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>Reporte de Movimientos</h1>
      
    </header>
         <h3>Fecha de emisión: {{date('d-m-Y')}}</h3>
         @if($startDate == $endDate )
           <h3>Movimientos del día.</h3>
         @else
           <h3>Movimientos desde {{date("d-m-Y",strtotime($startDate))}} hasta {{date("d-m-Y",strtotime($endDate))}}.</h3>
        @endif
         
            <main>
             <table>
               
                  <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo</th>
                        <th>Monto</th>
                        <th></th>
                   </tr>
            </thead>
         
       
                <tbody>
                   @foreach ($movements as $movement) 
                       <tr>
                    <td class="text-center">{{$movement->concept}}</td>
                    <td class="text-center">{{$movement->created_at->format('d-m-y')}}</td>  
                    <td class="text-center">{{date_format($movement->created_at,'H')}}:{{date_format($movement->created_at,'i')}}</td> 
                    <td class="text-center">{{$movement->type}}</td>
                    <td class="text-center">${{$movement->rode}}</td>
                 </tr>     
                    @endforeach

                </tbody>
              </table> 
              <div class="col-xs-6 movements">
               <table class="table table-bordered" style="width: 150px">
                  <tr style="background-color: orange;">
                    <th  class="text-center">TOTAL ENTRADAS</th>
                    <th  class="text-center">TOTAL SALIDAS</th>
                    <th  class="text-center">TOTAL CAJA</th>
                  </tr>
                  <tr>
                    <td  class="text-center">${{$totalIncomes}}</td>
                    <td  class="text-center">${{$totalOutcomes}}</td>
                    <td  class="text-center">${{$totalIncomes-$totalOutcomes}}</td>   
                  </tr>
               </table>
               </div>
            </main>

            

    <footer>
     
    </footer>
    
  </body>
</html>