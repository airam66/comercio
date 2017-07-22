<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Provider;
use App\Purchase;
use App\PurchaseProduct;
class PurchasesController extends Controller
{   

	public function __construct()
    {
        $this->middleware('auth');
        $this->provider=new Provider();
    }
    public function index(Request $request){
        $purchases=Purchase::all()->where('status','<>','rechazada');
      return view('admin.purchases.index')->with('purchases',$purchases);
    }

    public function create(){
    	  $date=date('d').'/'.date('m').'/'.date('Y');
        $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
        $providers=Provider::where('status','=','activo')->orderBy('name','ASC')->get();
        $numberPurchase=Purchase::all()->pluck('id');
        $title="BUSCAR PROVEEDOR";
        if (count($numberPurchase)!=0){
          $numberPurchase=($numberPurchase->last()+1);
        }else{
          $numberPurchase=1;
        }

    	return view('admin.purchases.create')->with('date',$date)
                                          ->with('products',$products)
                                          ->with('providers',$providers)
                                          ->with('numberPurchase',$numberPurchase)
                                          ->with('title',$title);
                                          
    }

    public function store(Request $request){

      $this->validate($request,[
          'cuit'=>'required|exists:providers,cuit',
        

        ]);
        
        $purchase = new Purchase;
            $purchase->total=$request->get('TotalCompra');
            
            $purchase->provider_id=$request->get('provider_id');

            if ($purchase->total>0){
                 $purchase->save();
            }
            else{
                  flash("Debe ingresar al menos un producto" , 'danger')->important();
            }


            //+++++++++++++INICIAMOS CAPTURA DE VARIABLES ARREGLO[] PARA DETALLEDE ordencompra//++++++++++++++++++

            $idarticulo = $request->get('dproduct_id');
            $amount = $request->get('damount');
            $price = $request->get('dprice');

            $cont =0;

            while ( $cont <  count($idarticulo) ) {
                //dd($cont);
                $detalle = new PurchaseProduct();
                $detalle->purchase_id=$purchase->id; //le asignamos el id de la venta a la que pertenece el detalle
                $detalle->product_id=$idarticulo[$cont];
                $detalle->amount=$amount[$cont];
                $detalle->price=$price[$cont];
                $detalle->subTotal=$amount[$cont]*$price[$cont];

                if ($purchase->total>0){
                   $detalle->save(); 
                }
                               
                $cont = $cont+1;

            }




            return redirect()->route('purchases.index');
    }


     public function desable(Request $request){
        $purchase= Purchase::find($request->id);
        $purchase->delete();
       

        return redirect()->route('purchases.index');
    }


//###################Edit Purchase########################
    public function edit($id)
    {     
        $purchase=Purchase::find($id);
        $details= DB::table('purchases_products as pp')
              ->join('products as p','pp.product_id','=','p.id')
              ->join('brands as b','p.brand_id','=','b.id')
              ->select('p.id as product_id','p.name as product_name','pp.price','b.name as brand_name','pp.amount','pp.subTotal')
              ->where('pp.purchase_id','=',$id)->get();

        return view('admin.purchases.edit')->with('purchase',$purchase)
                                            ->with('details',$details);                                
    }

    public function update(Request $request, $id){
     
      $purchase=Purchase::find($id);
      $purchase->total=$request->get('TotalCompra'); 

      if ($purchase->total>0){
                 $purchase->save();
            }
            else{
                  flash("Debe ingresar al menos un producto" , 'success')->important();
            }
      DB::table('purchases_products')->where('purchase_id','=',$id)->delete();
      $idarticulo = $request->get('dproduct_id');
            $amount = $request->get('damount');
            $price = $request->get('dprice');

             $cont =0;

            while ( $cont <  count($idarticulo) ) {
                //dd($cont);
                $detalle = new PurchaseProduct();
                $detalle->purchase_id=$purchase->id; //le asignamos el id de la venta a la que pertenece el detalle
                $detalle->product_id=$idarticulo[$cont];
                $detalle->amount=$amount[$cont];
                $detalle->price=$price[$cont];
                $detalle->subTotal=$amount[$cont]*$price[$cont];

                if ($purchase->total>0){
                   $detalle->save(); 
                }
                               
                $cont = $cont+1;

            }

    
        flash("La factura N° ". $purchase->id . " ha sido modificada con exito" , 'success')->important();
     

       return redirect()->route('purchases.index');


    }



//################### Search ################################


    public function searchProducts(Request $request){
      if($request->ajax()){
        $output="";
        $comilla="'";
      $products= DB::table('providers_products as pp')
              ->join('products as p','pp.product_id','=','p.id')
              ->join('brands as b','p.brand_id','=','b.id')
              ->select('code','p.id as product_id','p.name as product_name','purchase_price','b.name as brand_name','stock','p.status','b.name')
              ->where('p.name','LIKE', "%".$request->searchProducts."%")
              ->where('p.status','=','activo')
              ->where('b.name',"<>","CREATÚ")
              ->where('pp.provider_id','=',$request->provider_id)->get();
     

       if ($products) {
        foreach ($products as $key => $product) {
          
                  $output.='<tr>'.
                        '<td>'.$product->code.'</td>'.
                        '<td>'.$product->product_name.'</td>'.
                        '<td>'.$product->stock.'</td>'.

                        '<td><a onclick="complete('.$product->product_id.','.$product->code.','.$comilla.$product->brand_name.$comilla.','.$comilla.$product->product_name.$comilla.','.$product->purchase_price.','.$product->stock.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }
      
        return Response($output);
          
       }        
   
    }
    }


     public function searchProvider(Request $request){
   
      if($request->ajax()){
  
      $providers=Provider::searchProvider($request->searchP)->where('status','=','activo')->get();
      $type="Provider";
      $result=popUpPeople($providers,$type);
      return Response($result);    
   
    }
    }

    public function show($id){
      
      $purchase= Purchase::find($id);
      $details= DB::table('purchases_products as dp')
      ->join('products as p','dp.product_id','=','p.id')
      ->join('brands as b','b.id','=','p.brand_id')
      ->select('p.id','p.name as product_name','b.name as brand_name','dp.price','dp.amount','dp.subTotal')
      ->where('dp.purchase_id','=',$id)->get();
   

      $date = date('Y-m-d');
      $vistaurl="admin.purchases.purchaseOrder";
      $view= \View::make($vistaurl,compact('purchase','details','date'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream();
    }


     public function autocompleteProvider(Request $request){
           
            return $this->provider->providerByCuit($request->input('p'));
    }

    /* public function autocompleteProduct(Request $request){
           
            return $this->provider->productByCodeProvider($request->input('p'),$request->provider_id);
    }*/

     public function detailPurchase(Request $request){

    $cont=0;
    $TotalCompra=0;
    $Subtotal=[];

    if($request->ajax()){
        $output="";
        $comilla="'";
        $products= DB::table('providers_products as pp')
              ->join('products as p','pp.product_id','=','p.id')
              ->join('brands as b','p.brand_id','=','b.id')
              ->select('code','p.id as product_id','p.name as product_name','purchase_price','b.name as brand_name','stock')
              ->where('p.stock','<',10)
              ->where('b.name',"<>","CREATU")
              ->where('pp.provider_id','=',$request->provider_id)->get();

     
       if ($products) {
        foreach ($products as $key => $product) {
       
                 $Subtotal[$cont]=0;
                  $output.='
                       <tr class="selected" id="'.$cont.'">
                        <td><button type="button" class="btn btn-danger" onclick="deletefila('.$cont.',$('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val())">X</button></td>
                        <input readonly type="hidden" name="dproduct_id[]" value="'.$product->product_id.'">'.
                        '<td>'.$product->product_name.'</td>'.
                        '<td>'.$product->brand_name.'</td>'.
                        '<td><input readonly type="number" name="dprice[]" value="'.$product->purchase_price.'" class="mi_factura"</td>
                        <td><input id="damount" name="damount[]" type="number" onkeyup="$('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val(this.value*'.$product->purchase_price.')" onchange="$('.$comilla.'#TotalCompra'.$comilla.').val(parseFloat($('.$comilla.'#TotalCompra'.$comilla.').val())+ parseFloat($('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val()))"></td>'.
                        '<td><input readonly id="dsubTotal'.$cont.'" name="dsubtTotal" class="mi_factura" type="number" value='.$Subtotal[$cont].'></td>'

                    .'</tr>';
                    $cont++;
                    
        }


   
        return Response($output);
          
       } 

   
    }
    }




    public function searchDate(Request $request){
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $purchases=Purchase::SearchPurchase($request->fecha1,$request->fecha2)->get();
       if ($purchases) {
        foreach ($purchases as $key => $purchase) {
         
                if ($purchase>status!='rechazada'){
                  $output .='<tr role="row" class="odd">';
                }
                else{
                  $output .='<tr role="row" class="odd" style="background-color: rgb(255,96,96);">';
                };
                  $output=$output.
                        '<td>'.$purchase->id.'</td>'.
                        '<td>'.$purchase->created_at.'</td>'.
                        '<td>'.$purchase->provider->name.'</td>'.
                        '<td>'.$purchase->status.'</td>'.
                        '<td>
                         
                        <button type="button" class="btn btn-primary "  data-title="Detail"">
                         <i class="fa fa-list" aria-hidden="true"></i>
                          </button>';

                          if ($purchase->status!='rechazada'){
                            $output .= '<a  onclick="return confirm('.$comilla.'¿Seguro dara de baja esta factura?'.$comilla.')">
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



}
