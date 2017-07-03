<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Provider;
class PurchasesController extends Controller
{   

	public function __construct()
    {
        $this->middleware('auth');
        $this->provider=new Provider();
    }
    public function index(Request $request){
     // return view('admin.invoices.index');
    }

    public function create(){
    	  $date=date('d').'/'.date('m').'/'.date('Y');
        $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
        $providers=Provider::where('status','=','activo')->orderBy('name','ASC')->get();
    	return view('admin.purchases.create')->with('date',$date)
                                          ->with('products',$products)
                                          ->with('providers',$providers);
                                          
    }

    public function store(Request $request){

    }


    public function search(Request $request){
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $products=Product::SearchProduct($request->search)->get();
       if ($products) {
        foreach ($products as $key => $product) {
                  $output.='<tr>'.
                        '<td>'.$product->code.'</td>'.
                        '<td>'.$product->name.'</td>'.
                        '<td>'.$product->stock.'</td>'.

                        '<td><a onclick="complete('.$product->id.','.$comilla.$product->code.$comilla.','.$comilla.$product->name.$comilla.','.$product->wholesale_price.','.$product->retail_price.','.$product->stock.','.$product->wholesale_cant.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return Response($output);
          
       }        
   
    }
    }


     public function searchProvider(Request $request){
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $providers=Provider::searchProvider($request->searchProvider)->get();
       if ($providers) {
        foreach ($providers as $key => $provider) {
                  $output.='<tr>'.
                        '<td>'.$provider->cuit.'</td>'.
                        '<td>'.$provider->name.'</td>'.
                        '<td>'.$provider->address.'</td>'.
                        '<td>'.$provider->phone.'</td>'.
                        '<td>'.$provider->email.'</td>'.

                        '<td><a onclick="completeC('.$comilla.$provider->id.$comilla.','.$provider->cuit.','.$comilla.$provider->name.$comilla.')" type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return Response($output);
          
       }        
   
    }
    }
     public function autocompleteProvider(Request $request){
           
            return $this->provider->providerByCuit($request->input('p'));
    }



}
