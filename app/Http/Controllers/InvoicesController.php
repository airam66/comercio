<?php

namespace App\Http\Controllers;

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
            $venta->client_id=$request->get('client_id');
            $venta->discount=$request->get('discount');
            $venta->total=$request->get('Totalventa');
            $venta->status=$request->get('status');
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

            return redirect()->route('invoices.index');

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

                        '<td><button type="button" class="btn btn-primary " data-toggle="modal" id="Detail" data-title="Detail" data-target="#favoritesModalDetail">
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

    public function autocomplete(Request $request){
        
            return $this->products->productByCode($request->input('q'));

    }


     public function autocompleteClient(Request $request){
           
            return $this->clients->clientByCuit($request->input('p'));
    }


    public function show(){
      return view ('admin.invoices.show');
    }
}
