<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\Invoice;
use App\InvoiceProduct;
use App\Movement;
class InvoicesController extends Controller
{   
    private $products=null;

	public function __construct()
    {
       
        $this->products= new Product();
        $this->clients=new Client();
    }
    

    public function index(Request $request){

      $fecha1=$request->fecha1;
      $fecha2=$request->fecha2;
     $invoices=Invoice::orderBy('id','DESC')->paginate(15);

      if($request->fecha1!='' and $request->fecha2!=''){

         $fecha1=$request->fecha1;
         $fecha2=$request->fecha2;
         $invoices=Invoice::SearchInvoice($request->fecha1,$request->fecha2)
                            ->orderBy('id','DESC')->paginate(15);


     }
      
      return view('admin.invoices.index')->with('invoices',$invoices)->with('fecha1',$fecha1)->with('fecha2',$fecha2);

    }

    public function create(){
    	$date=date('d').'/'.date('m').'/'.date('Y');
        
        $numberinvoice=Invoice::all()->pluck('id');
        if (count($numberinvoice)!=0){
          $numberinvoice=($numberinvoice->last()+1);
        }else{
          $numberinvoice=1;
        }
        $title="BUSCAR CLIENTE";
    	return view('admin.invoices.create')->with('date',$date)
                                          
                                          ->with('numberinvoice',$numberinvoice)
                                          ->with('title',$title);
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
            if ($venta->total>0){
                 $venta->save();
                 $income=new Movement();
                 $income->concept="Venta N° ".$invoice->id;
                 $income->type="entrada";
                 $income->rode=$venta->total;
            }
            else{
                  flash("Debe ingresar al menos un producto" , 'danger')->important();
            }
           
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

            return redirect()->route('invoices.index',$venta->id);

    }


    public function search(Request $request){
   
      if($request->ajax()){
       
        $products=Product::SearchProduct($request->search)->where('status','=','activo')->get();       
        $result=popUpProductsInvoice($products);
        return Response($result);
      }
    }


     public function searchClient(Request $request){
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $clients=Client::searchClient($request->searchClient)->where('status','=','activo')->get();
      $type="Client";
      $result=popUpPeople($clients,$type);
      return Response($result);
    }
    }

    public function searchL(Request $request){
   

      if($request->ajax()){
    
          $products=Product::SearchProductL($request->searchL)->get();

         $result=popUpProductsInvoice($products);
         return Response($result);
              
   
        }
    }


public function searchDate(Request $request){
     
      if($request->ajax()){
        $output="";
        $comilla="'";
      $invoices=Invoice::SearchInvoice($request->fecha1,$request->fecha2)->get();
       if ($invoices) {
        foreach ($invoices as $key => $invoice) {
         
                if ($invoice->status!='inactivo'){
                  $output .='<tr role="row" class="odd">';
                }
                else{
                  $output .='<tr role="row" class="odd" style="background-color: rgb(255,96,96);">';
                };
                  $output=$output.
                        '<td class="text-center">'.$invoice->id.'</td>'.
                        '<td>'.$invoice->created_at->format('d/m/Y').'</td>'.
                        '<td>'.$invoice->client->name.'</td>'.
                        '<td>$'.$invoice->total.'</td>'.
                        '<td>
                         
                        <button type="button" class="btn btn-primary "  data-title="Detail" onclick="myDetail('.$invoice->id.')">
                         <i class="fa fa-list" aria-hidden="true"></i>
                          </button>';

                          if ($invoice->status!='inactivo'){
                            $output .= '<a  onclick="return confirm('.$comilla.'¿Seguro dara de baja esta factura?'.$comilla.')" href='.$invoice->desable.'>
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>';
                            }
                

                          
                     

                  $output .= '</tr>';
          }
        } 
   
        return Response($output);
          
               
   
    
    }
  }


  //***************************GENERAR PDF PARA IMPRIMIR FACTURA****************************************
  public function pdfInvoice($id){
      
      $invoice= Invoice::find($id);
      $details= DB::table('invoices_products as ip')
      ->join('products as p','ip.product_id','=','p.id')
      ->select('p.id','p.name as product_name','ip.price','ip.amount','ip.subTotal')
      ->where('ip.invoice_id','=',$id)->get();

      $date = date('Y-m-d');
      $vistaurl="admin.invoices.pdfInvoices";
      $view= \View::make($vistaurl,compact('invoice','details','date'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream();
    }

    //********************************Desabilitar una factura**************************************//

       public function desable($id)
    {   
        
        $invoice= Invoice::find($id);
        
         $invoiceProducts=InvoiceProduct::where('invoices_id','=',$id)->get();
                 foreach ($purchaseProducts as $purchaseProduct) {
                    $product=Product::find($invoiceProduct->product_id);
                    $product->stock = $product->stock-$invoiceProduct->amount;
                    $product->save();
                    $purchaseProduct->delete();
                }

        $invoice->status='inactivo';
        $invoice->save();

        return redirect()->route('invoices.index');
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



    
    function print($id){
      
      $invoice= Invoice::find($id);
      $detalles= DB::table('invoices_products as d')
      ->join('products as p','d.product_id','=','p.id')
      ->select('d.price','p.name','d.amount','d.subTotal')
      ->where('d.invoice_id','=',$id)->get();
    
      return  view ('admin.invoices.invoice-print')->with('invoice',$invoice)
                                          ->with('detalles',$detalles);

    }
}
