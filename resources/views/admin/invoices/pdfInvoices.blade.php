<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Factura</title>
    <link rel="shortcut icon" type="image/x-ico" href="{{ asset('images/logoss.ico')}}">
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
   
  </head>
  <body >


  <table>
    <tr>
      <th>
        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
      </th>

      <th>
        <div class="pull-right">
        <h3 class="page-header" style="color:gray;">
            <b id="id">Comprobante N°: {{$invoice->id}}</b><br><br>
            <b>Fecha: {{$invoice->created_at->format('d-m-Y')}}</b>
        </h3>
        </div>
      </th>
    </tr>
  </table> 

  <table>
    <tr>
      <th>
        <div class="col-sm-6 invoice-col">
        <p align="left">
            DE<br>
              <strong>Cotillón CreaTu</strong><br>
              Direccion:Roque Saenz Peña Nro 14 bis 2 <br>
              B° San Martin,Rosario de Lerma, Salta<br>
              Telefono: (387)59662005 - (387) 5910201<br>
              Email:creatucotillon@gmail.com
        </p>
        </div>
      </th>

      <th>
        <div class="col-sm-6 invoice-col ">
        <p align="left">
            A<br>
            <strong>SR/A :  {{$invoice->client->name}}</strong><br>
            CUIL/CUIT:{{$invoice->client->cuil}}<br>
        </p>
        </div>
      </th>
    </tr>
  </table>     
       
         
            <main>
             <table id="Detalle">
              <thead>
               <tr>
                <th>Producto</th>
                <th>Precio de Compra</th>
                <th>Cantidad</th>
                <th>Subtotal Estimado</th>
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
             </main>
                <div class="row">
                  
                  <div class="col-xs-6 total">
                  <div class="text-center" style="background-color: gray;">
                    <h3 style="color:white;">Total</h3>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          @if($invoice->discount!=0)
                            <td>$ {{($invoice->total/9)*10}}</td>
                          @else
                            <td>$ {{$invoice->total}}</td>
                          @endif
                          
                        </tr>
                        <tr>
                          <th>Descuento</th>
                          <td>{{$invoice->discount}}%</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>$ {{$invoice->total}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>  

              <div class="row ">
                <div class=" col-xs-12 text-center">
            
                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Comprobante no válido como factura. Cotillón Creatú.
                  </p>
               </div>
              

    <footer>
    
    </footer>
    
  </body>
</html>