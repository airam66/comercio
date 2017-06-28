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

    public function store(){
    	//
    }

    public function autocomplete(Request $request){
         
            return $this->products->productByCode($request->input('q'));
    }
}
