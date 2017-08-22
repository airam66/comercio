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
        return view('admin.providers.create');
    }

    
    public function store(ProviderRequest $request)
    {
        $providers= new Provider($request->all());
        $providers->save();
         flash("El proveedor ". $providers->name . " ha sido registrado con exito" , 'success')->important();
       return redirect()->route('providers.index');

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
    	$provider= Provider::find($id);


        return view('admin.providers.edit')->with('provider',$provider);


    }

   
    public function update(Request $request, $id)
    {
      $provider=Provider::find($id);
      $provider->fill($request->all());
      $provider->save();
      flash("El proveedor ". $provider->name . " ha sido modificado con éxito" , 'success')->important();
     

       return redirect()->route('providers.index');

    }

    public function desable($id)
    {
      $provider= Provider::find($id);
      $provider->status='inactivo';
      $provider->save();
      return redirect()->route('providers.index');
    }

    public function enable($id)
    {
        $provider= Provider::find($id);
        $provider->status='activo';
        $provider->save();
        return redirect()->route('providers.index');
    }

    public function destroy($id)
    {

    }
}
