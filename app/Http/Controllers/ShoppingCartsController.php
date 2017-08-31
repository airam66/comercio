<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCartProduct;
use App\ShoppingCart;
use App\Product;
use Illuminate\Support\Facades\DB;
class ShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $shopping_cart_id=\Session::get('shopping_cart_id');
        $shopping_cart=ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $ShoppingCartProducts=$shopping_cart->ShoppingCartProducts()->get();

        $details= DB::table('shopping_cart_product as scp')
                          ->join('products as p','scp.product_id','=','p.id')
                          ->select('scp.id as shopping_cart_id','p.id as product_id','p.extension','p.name as product_name','scp.price','scp.amount','scp.subTotal')
                          ->where('scp.shopping_cart_id','=',$shopping_cart->id)->get();
        //dd($details);

        return view('main.pagine.shoppingcart.edit')->with('shopping_cart',$shopping_cart)
                                                    ->with('details',$details); 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shoppingcart=ShoppingCart::find($id);

        $idarticulo = $request->get('product_id');
        $idshoppingcart = $request->get('dproduct_id');
        $amount = $request->get('damount');

            $cont =0;
            while ( $cont <count($idarticulo) ) {
                $detalle = ShoppingCartProduct::find($idshoppingcart[$cont]);
                $product = Product::find($idarticulo[$cont]);

                if ($amount[$cont]>=$product->wholesale_cant){
                    $detalle->subTotal=$product->wholesale_price*$amount[$cont];
                    $detalle->price=$product->wholesale_price;
                }else{
                    $detalle->subTotal=$product->retail_price*$amount[$cont];
                    $detalle->price=$product->retail_price;
                }

                $detalle->amount=$amount[$cont];

                $detalle->save();
                               
                $cont = $cont+1;

            }
        $shoppingcart->total=$shoppingcart->total(); 
        if($shoppingcart->user_id==null){
            $shoppingcart->user_id=$request->user_id;
            }

      if ($shoppingcart->total>0){
                 $shoppingcart->save();
            }
            else{
                  flash("Debe ingresar al menos un producto" , 'success')->important();
            }

        flash("El carrito ha sido modificada con exito" , 'success')->important();
     

       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     

//***************************GENERAR PDF PARA IMPRIMIR PEDIDO****************************************
  public function pdfOrderOnline(){
      $user=\Auth::user();

      $shoppingCart=$user->shoppingCarts->last();

      $details=ShoppingCartProduct::searchOrderOnline($shoppingCart->id)->get();  

      $vistaurl="main.pagine.shoppingcart.pdfOrderOnline";
      $view= \View::make($vistaurl,compact('shoppingCart','details'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream();
    }
}
