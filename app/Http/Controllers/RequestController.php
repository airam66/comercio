<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\OrderRequest;
use App\OrderRequestProduct;


class RequestController extends Controller
{
    
    public function index(){

    }
    public function create()
    {
 	   
 	   $date=date('d').'/'.date('m').'/'.date('Y');

 	   $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
        $clients=Client::where('status','=','activo')->orderBy('name','ASC')->get();
       // $numberinvoice=Invoice::all()->pluck('id');
       // if (count($numberinvoice)!=0){
          //$numberinvoice=($numberinvoice->last()+1);
       // }else{
          //$numberinvoice=1;
        //}
        $title="BUSCAR CLIENTE";        
        return view('admin.request.create')->with('date',$date)
                                           ->with('products',$products)
                                           ->with('clients',$clients)
                                          //->with('numberinvoice',$numberinvoice)
                                          ->with('title',$title);
    }



    public function store(Request $request){

    	       $orderRequest = new OrderRequest;
             
            $orderRequest->total=$request->get('total');
            $orderRequest->client_id=$request->get('client_id');
            $orderRequest->delivery_date=date("Y-m-d",strtotime($request->get('datetimepicker3')));
            $orderRequest->advance=$request->get('advance');
            if ($orderRequest->total>0){
                 $orderRequest->save();
                 $client=Client::find($orderRequest->client_id);
                 $client->bill=$request->get('balance');
                 $client->save();
            }
            else{
                  flash("Debe ingresar al menos un producto" , 'danger')->important();
            }

            
            //+++++++++++++INICIAMOS CAPTURA DE VARIABLES ARREGLO[] PARA DETALLEDE orderRequest//++++++++++++++++++
            $idarticulo = $request->get('dproduct_id');
            $amount = $request->get('damount');
            $price = $request->get('dprice');

            $cont = 0;

            while ( $cont < count($idarticulo) ) {
                $detalle = new OrderRequestProduct();
                $detalle->request_id=$orderRequest->id; //le asignamos el id de la orderRequest a la que pertenece el detalle
                $detalle->product_id=$idarticulo[$cont];
                $detalle->amount=$amount[$cont];
                $detalle->price=$price[$cont];
                $detalle->subTotal=$amount[$cont]*$price[$cont];
                if ($orderRequest->total>0){
                   $detalle->save(); 
                }
               
                $cont = $cont+1;

            }

            return redirect()->route('requests.index',$orderRequest->id);


    }

}
