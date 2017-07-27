<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProviderProduct;
use App\Provider;
use App\Product;
use App\Http\Requests\ProviderRequest;

class ProvidersProductsController extends Controller
{
    
    public function index(Request $request)
    {
      
       /* return view('admin.products.index')->with('products',$products)*/

    }

    public function create()
    {
        $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
        $providers=Provider::where('status','=','activo')->orderBy('name','ASC')->get();
        return view('admin.providersproducts.create')->with('products',$products)
                                                     ->with('providers',$providers);
    }

    
    public function store(Request $request)
    {
    	
            $idarticulo = $request->get('dproduct_id');

            $cont = 0;

            while ( $cont < count($idarticulo) ) {
                $detalle = new ProviderProduct();
                $detalle->provider_id=$request->provider_id; 
                $detalle->product_id=$idarticulo[$cont];
                $detalle->save();
                $cont = $cont+1;
            }
       
        return redirect()->route('providersproducts.create');

    }

     
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {   
    	/*$product= Product::find($id);


        return view('admin.products.edit')->with('product',$product)*/


    }

   
    public function update(Request $request, $id)
    {
    }

    public function desable($id)
    {
    }

    public function enable($id)
    {
      /*  $product= Product::find($id);
        $product->status='activo';
        $product->save();
        return redirect()->route('products.index');*/
    }

    public function destroy($id)
    {

    }
}
