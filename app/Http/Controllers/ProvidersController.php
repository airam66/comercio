<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

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
       $providers=Provider::SearchProvider($request->name)->orderBy('name','status','ASC')->paginate(10);
      
       return view('admin.providers.index')->with('providers',$providers);

    }

    public function create()
    {   
        $route=redirect()->back()->getTargetUrl();
        return view('admin.providers.create')->with('route',$route);
    }

    
    public function store(ProviderRequest $request)
    {
        $providers= new Provider($request->all());
        $providers->save();
        return redirect()->to($request->route);

    }

     public function listProducts(Request $request){

      if($request->ajax()){
      
         $output="";
         $comilla="'";
         $products= DB::table('providers_products as pp')
              ->join('products as p','pp.product_id','=','p.id')
              ->join('brands as b','p.brand_id','=','b.id')
              ->select('p.name as product_name','b.name as brand_name','p.stock','p.status','pp.provider_id')
              ->where('p.status','=','activo')
              ->where('pp.provider_id','=',$request->provider_id)->get();
         

         if ($products) {
           foreach ($products as $key => $product) {
           //dd($products);
                  $output.='<tr>'.
                       
                        '<td>'.$product->product_name.'</td>'.
                        '<td>'.$product->brand_name.'</td>'.
                        '<td>'.$product->stock.'</td>'.


                    '</tr>';
        }
      
        return Response($output);
          
       }        
   
    }
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
