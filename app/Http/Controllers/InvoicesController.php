<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class InvoicesController extends Controller
{   
    private $products=null;

	public function __construct()
    {
        $this->middleware('auth');
        $this->products= new Product();
    }

    public function create(){
    	$date=date('d').'/'.date('m').'/'.date('Y');
        $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
    	return view('admin.invoices.create')->with('date',$date)
                                            ->with('products',$products);
    }

    public function SearchLetra($letra){
     

      $products=Product::SearchProductL($letra)->get();
     
      return view('admin.invoices.create')->with('products',$products);
    }

    public function store(){
    	//
    }

    public function autocomplete(Request $request){
         
            return $this->products->productByCode($request->input('q'));
    }
}
