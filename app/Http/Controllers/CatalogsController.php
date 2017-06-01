<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;	
use App\Event;

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
 public function SearchEvent($name){
 		$event= Event::searchEvent($name)->first();
 		$products= $event->products()->paginate(5);
 		$products->each(function($products){
 			$products->event;
 			$products->extencion;
 		});

 		return view('main.pagine.Catalogue')->with('products',$products);
 		

 }


   
   
}
