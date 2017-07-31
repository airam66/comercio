<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderProduct;
use App\Client;

class OrdersController extends Controller
{
    public function index(Request $request){

      $orders=Order::orderBy('created_at','DESC')->paginate(15);
      
       $orders->each(function($orders){
     
          $orders->client;
       

     });

        if ($request->searchClient!=''){
         $client= Client::SearchClient($request->searchClient)->first();
          if ($client != null){
          $orders=$client->orders()->paginate(15);
         }
         else{
          $orders=[];
         }
     }
      

      return view('admin.orders.index')->with('orders',$orders);
      

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
        return view('admin.orders.create')->with('date',$date)
                                           ->with('products',$products)
                                           ->with('clients',$clients)
                                          //->with('numberinvoice',$numberinvoice)
                                          ->with('title',$title);
    }



    public function store(Request $request){

    	       $order = new Order;
             
            $order->total=$request->get('total');
            $order->client_id=$request->get('client_id');
            $order->delivery_date=date("Y-m-d",strtotime($request->get('datetimepicker3')));
            $order->advance=$request->get('advance');
            if ($order->total>0){
                 $order->save();
                 $client=Client::find($order->client_id);
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
                $detalle = new OrderProduct();
                $detalle->order_id=$order->id; //le asignamos el id de la orderRequest a la que pertenece el detalle
                $detalle->product_id=$idarticulo[$cont];
                $detalle->amount=$amount[$cont];
                $detalle->price=$price[$cont];
                $detalle->subTotal=$amount[$cont]*$price[$cont];
                if ($order->total>0){
                   $detalle->save(); 
                }
               
                $cont = $cont+1;

            }

            return redirect()->route('orders.index',$order->id);


    }

     public function searchDateOrder(Request $request){
     
      if($request->ajax()){
        $output="";
        $comilla="'";

      $orders=Order::SearchOrder($request->fecha1,$request->fecha2)->get();
     
  
       if ($orders) {
        foreach ($orders as $key => $order) {
         
                if ($order->status!='cancelada'){
                  $output .='<tr role="row" class="odd">';
                }
                else{
                  $output .='<tr role="row" class="odd" style="background-color: rgb(255,96,96);">';
                }
                  $output .=
                        '<td>'.$order->id.'</td>'.
                        '<td>'.$order->created_at->format('d/m/Y').'</td>'.
                        '<td>'.date('d/m/Y', strtotime($order->delivery_date)).'</td>'.
                        '<td>'.$order->client->name.'</td>'.
                        '<td>'.$order->status.'</td>'.
                        '<td>'.$order->client->bill.'</td>'.
                        
                        '<td>
                            <a target="_blank"  href='.$order->url.'> <button  type="button" class="btn btn-primary">
                                 Generar PDF</button></a>
                            <a href='.$order->edit.'>
                                          <button type="submit" class="btn btn-warning" name="edit">
                                              <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                                      
                                          </button>
                                </a>
                               
                            </td>
                            <td>
                              <a href='.$order->remove.' onclick="return confirm('.$comilla.'¿Seguro dará de baja este pedido?'.$comilla.')">
                                   <button type="submit" class="btn btn-danger" name="delete">
                                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                                        </button>
                              </a>
                               
			                 </td>';
                        
        
                
         $output .='</tr>';
                          
                     

                  
          }
        } 
         
        return Response($output);
          
               
   }
    
  }
//*******************************EDITAR UN PEDIDO******************
  public function edit($id){
     
    $order=Order::find($id);
  
    $details= DB::table('order_product as op')
              ->join('products as p','op.product_id','=','p.id')
              ->select('p.id as product_id','p.name as product_name','p.code as product_code','op.price','op.amount','op.subTotal')
              ->where('op.order_id','=',$id)->get();

    $title="BUSCAR CLIENTE";

    return view('admin.orders.edit')->with('order',$order)
                                    ->with('details',$details)
                                      ->with('title',$title);


  }


  public function update(Request $request,$id){

  	$order=Order::find($id);
      $order->total=$request->get('total'); 
      $order->delivery_date=date("Y-m-d",strtotime($request->get('datetimepicker3')));

      if ($order->total>0){
                 $order->save();
                 $client=Client::find($order->client_id);
                 $client->bill=$request->get('balance');
                 $client->save();
            }
            else{
                  flash("Debe ingresar al menos un producto" , 'success')->important();
            }
      DB::table('order_product')->where('order_id','=',$id)->delete();
      $idprod = $request->get('dproduct_id');
            $amount = $request->get('damount');
            $price = $request->get('dprice');

             $cont =0;

            while ( $cont <  count($idprod) ) {
                //dd($cont);
                $detail = new OrderProduct();
                $detail->order_id=$order->id; //le asignamos el id de la venta a la que pertenece el detail
                $detail->product_id=$idprod[$cont];
                $detail->amount=$amount[$cont];
                $detail->price=$price[$cont];
                $detail->subTotal=$amount[$cont]*$price[$cont];

                if ($order->total>0){
                   $detail->save(); 
                }
                               
                $cont = $cont+1;

            }

    
        flash("El pedido N° ". $order->id . " ha sido modificado con éxito" , 'success')->important();
     

       return redirect()->route('orders.index');


  }
  
//*****************************DAR DE BAJA UN PEDIDO*******************************************

  public function destroy($id){

  	Order::destroy($id);

  	flash("El pedido ha sido dado de baja exitosamente" , 'success')->important();
     

       return redirect()->route('orders.index');
  }

//***************************GENERAR PDF PARA IMPRIMIR PEDIDO****************************************
  public function pdfOrder($id){
      
      $order=Order::find($id);
      $details= DB::table('order_product as op')
      ->join('products as p','op.product_id','=','p.id')
      ->select('p.id as product_id','p.name as product_name','op.price','op.amount','op.subTotal')
      ->where('op.order_id','=',$id)->get();
   

      $date = date('Y-m-d');
      $vistaurl="admin.orders.pdfOrder";
      $view= \View::make($vistaurl,compact('order','details','date'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream();
    }
}
