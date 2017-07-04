<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\Invoice;
use App\InvoiceProduct;
class InvoicesController extends Controller
{   
    private $products=null;

	public function __construct()
    {
        $this->middleware('auth');
        $this->products= new Product();
        $this->clients=new Client();
    }
    public function index(Request $request){
      return view('admin.invoices.index');
    }

    public function create(){
    	$date=date('d').'/'.date('m').'/'.date('Y');
        $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
        $clients=Client::where('status','=','activo')->orderBy('name','ASC')->get();
        $numberinvoice=Invoice::all()->pluck('id');
        if (count($numberinvoice)!=0){
          $numberinvoice=($numberinvoice->last()+1);
        }else{
          $numberinvoice=1;
        }
    	return view('admin.invoices.create')->with('date',$date)
                                          ->with('products',$products)
                                          ->with('clients',$clients)
                                          ->with('numberinvoice',$numberinvoice);
    }

    public function store(Request $request){
            $venta = new Invoice;
            $venta->total=$request->get('Totalventa');
            $venta->status=$request->get('status');
            $venta->client_id=$request->get('client_id');
            if (empty($venta->client_id)){
              $venta->client_id=1;
            }
            $venta->discount=$request->get('discount');
            if (empty($venta->discount)){
              $venta->discount=0;
            }
            $venta->save();
            //+++++++++++++INICIAMOS CAPTURA DE VARIABLES ARREGLO[] PARA DETALLEDE VENTA//++++++++++++++++++
            $idarticulo = $request->get('dproduct_id');
            $amount = $request->get('damount');
            $price = $request->get('dprice');

            $cont = 0;

            while ( $cont < count($idarticulo) ) {
                $detalle = new InvoiceProduct();
                $detalle->invoice_id=$venta->id; //le asignamos el id de la venta a la que pertenece el detalle
                $detalle->product_id=$idarticulo[$cont];
                $detalle->amount=$amount[$cont];
                $detalle->price=$price[$cont];
                $detalle->subTotal=$amount[$cont]*$price[$cont];
                $detalle->save();
                $cont = $cont+1;

            }

            return redirect()->route('invoices.show',$venta->id);

    }


    public function search(Request $request){
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $products=Product::SearchProduct($request->search)->get();
       if ($products) {
        foreach ($products as $key => $product) {
                  $output.='<tr>'.
                        '<td>'.$product->code.'</td>'.
                        '<td>'.$product->name.'</td>'.
                        '<td>'.$product->stock.'</td>'.

                        '<td><a onclick="complete('.$product->id.','.$comilla.$product->code.$comilla.','.$comilla.$product->name.$comilla.','.$product->wholesale_price.','.$product->retail_price.','.$product->stock.','.$product->wholesale_cant.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return Response($output);
          
       }        
   
    }
    }


     public function searchClient(Request $request){
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $clients=Client::searchClient($request->searchClient)->get();
       if ($clients) {
        foreach ($clients as $key => $client) {
                  $output.='<tr>'.
                        '<td>'.$client->cuil.'</td>'.
                        '<td>'.$client->name.'</td>'.
                        '<td>'.$client->address.'</td>'.
                        '<td>'.$client->phone.'</td>'.
                        '<td>'.$client->email.'</td>'.
                       
                        '<td><a onclick="completeC('.$comilla.$client->id.$comilla.','.$client->cuil.','.$comilla.$client->name.$comilla.')" type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return Response($output);
          
       }        
   
    }
    }

    public function searchL(Request $request){
   

      if($request->ajax()){
        $output="";
        $comilla="'";
      $products=Product::SearchProductL($request->searchL)->get();
       if ($products) {
        foreach ($products as $key => $product) {
                  $output.='<tr>'.
                        '<td>'.$product->code.'</td>'.
                        '<td>'.$product->name.'</td>'.
                        '<td>'.$product->stock.'</td>'.

                        '<td><a onclick="complete('.$product->id.','.$comilla.$product->code.$comilla.','.$comilla.$product->name.$comilla.','.$product->wholesale_price.','.$product->retail_price.','.$product->stock.','.$product->wholesale_cant.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return Response($output);
          
       }        
   
    }
    }


public function searchDate(Request $request){
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $invoices=Invoice::SearchInvoice($request->fecha1,$request->fecha2)->get();
       if ($invoices) {
        foreach ($invoices as $key => $invoice) {
                  $output.='<tr>'.
                        '<td>'.$invoice->id.'</td>'.
                        '<td>'.$invoice->created_at.'</td>'.
                        '<td>'.$invoice->client->name.'</td>'.
                        '<td>'.$invoice->total.'</td>'.

                        '<td>
                         
                        <button type="button" class="btn btn-primary "  data-title="Detail" onclick="myDetail('.$invoice->id.')">
                         <i class="fa fa-list" aria-hidden="true"></i>
                          </button>
                         

                          <a href="" onclick="return confirm('.$comilla.'¿Seguro dara de baja el producto?'.$comilla.')">
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
                     <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                    </td>'


                    .'</tr>';
        }
          
   
        return Response($output);
          
       }        
   
    }
    }

       public function desable($id)
    {
        $invoice= Invoice::find($id);
        $invoice->status='inactivo';
        $invoice->save();
        return redirect()->route('admin.invoices.index');
    }

    public function autocomplete(Request $request){
        
            return $this->products->productByCode($request->input('q'));

    }


     public function autocompleteClient(Request $request){
           
            return $this->clients->clientByCuil($request->input('p'));
    }


    public function show($id){
      
      $invoice= Invoice::find($id);
      $detalles= DB::table('invoices_products as d')
      ->join('products as p','d.product_id','=','p.id')
      ->select('p.id','p.name','p.description','d.amount','d.subTotal')
      ->where('d.invoice_id','=',$id)->get();
    
      return view ('admin.invoices.show')->with('invoice',$invoice)
                                          ->with('detalles',$detalles);
    }


    public function print(Request $request){
      

      if($request->ajax()){

      $primera="";
      $segunda="";

      $invoice= Invoice::find($request->id);
      $detalles= DB::table('invoices_products as d')
      ->join('products as p','d.product_id','=','p.id')
      ->select('p.id','p.name','p.description','d.amount','d.subTotal')
      ->where('d.invoice_id','=',$request->id)->get();
      
      $primera='<div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> Cotillon CreaTú
              <small class="pull-right">Fecha:'.$invoice->created_at.'</small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-6 invoice-col">
            DE
            <address>
              <strong>Cotillon creaTu</strong><br>
              Direccion:Roque Saenz Peña Nro 14 bis 2 <br>
              B° San Martin,Rosario de Lerma, Salta<br>
              Telefono: (387)59662005 - (387) 5910201<br>
              Email:creatucotillon@gmail.com
            </address>
          </div><!-- /.col -->
          <div class="col-sm-6 invoice-col">
            A
            <address>
              <strong>John Doe</strong><br>
              795 Folsom Ave, Suite 600<br>
              San Francisco, CA 94107<br>
              Phone: (555) 539-1037<br>
              Email: john.doe@example.com
            </address>
          </div><!-- /.col -->
          
        </div><!-- /.row -->

        <!-- Table row -->
        <br>
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Descripcion</th>
                  <th>Cantidad </th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <br>
              <tbody>';
              foreach ($detalles as $key => $detalle) {
                 $segunda='<tr>
                          <td>'.$detalle->id.'</td>
                          <td>'.$detalle->name.'</td>
                          <td>'.$detalle->description.'</td>
                          <td>'.$detalle->amount.'</td>
                          <td>'.$detalle->subTotal.'</td>
                        </tr>';
                }
              $primera=$primera.$segunda.'</tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <img src="../../dist/img/credit/visa.png" alt="Visa">
            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
            <img src="../../dist/img/credit/american-express.png" alt="American Express">
            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              Comprbante no valido como factura. Contillón Creatu.
            </p>
          </div><!-- /.col -->
          <div class="col-xs-6">
            <p class="lead">Amount Due 2/22/2014</p>
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>'.$invoice->total.'</td>
                </tr>
                <tr>
                  <th>Descuento</th>
                  <td>'.$invoice->total.'%</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>'.$invoice->total.'</td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    ';
              }

    return Response($primera);

    }


    function print2(){
      return  view ('admin.invoices.invoice-print');
    }
}
