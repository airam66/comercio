<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;	

class CatalogsController extends Controller
{
   
    public function index()
    {
        $products= Product::orderBy('name','ASC')->paginate(5);
        return view('main.pagine.Catalogue')->with('products',$products);
    }

public function show($id)
    {
        
        $product=Product::find($id);
         return view('main.pagine.showProduct')->with('product', $product);
    }


   
   
}
