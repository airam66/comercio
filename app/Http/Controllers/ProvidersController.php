<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\Http\Requests\ProviderRequest;

class ProvidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
      
       /* return view('admin.products.index')->with('products',$products)*/

    }

    public function create()
    {
        return view('admin.providers.create');

    }

    
    public function store(ProviderRequest $request)
    {
        $providers= new Provider($request->all());
    	
        $providers->save();
       
        return redirect()->route('providers.create');

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
