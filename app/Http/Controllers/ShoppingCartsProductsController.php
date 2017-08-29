<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCartProduct;
use App\ShoppingCart;
use App\Product;
class ShoppingCartsProductsController extends Controller
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
        $shopping_cart_id=\Session::get('shopping_cart_id');
        $shopping_cart=ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        
        $product=Product::find($request->product_id);
        $repet='false';
        $shopping_cart_product=$shopping_cart->ShoppingCartProducts()->get();
        foreach ($shopping_cart_product as $scp) {
            if ($product->id==$scp->product_id){
                $repet='true';
                $id=$scp->id;
            }
        }
        if ($repet) {
           $response=ShoppingCartProduct::find($id);
           $response->amount++;
           if ($response->amount>=$product->wholesale_cant) {
                $response->subTotal=$product->wholesale_price*$response->amount;
                $response->price=$product->wholesale_price;
           }else{
                $response->subTotal=$product->retail_price*$response->amount;
                $response->price=$product->retail_price;
           }
           $response->save();
        }else{
            $response=ShoppingCartProduct::create([
                'shopping_cart_id'=>$shopping_cart_id,
                'product_id'=>$product->id,
                'price'=>$product->retail_price,
                'amount'=>1,
                'subTotal'=>$product->retail_price,
                ]);
        }
        
        $shopping_cart->total=$shopping_cart->total();
        $shopping_cart->save();


        return redirect('/catalogue');


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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ShoppingCartProduct::destroy($id);
        return redirect()->back();
    }
}
