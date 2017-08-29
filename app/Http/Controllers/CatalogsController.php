<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;	
use App\Event;
use App\Category;
use App\Carrusel;
use Illuminate\Support\Collection as Products;

class CatalogsController extends Controller
{
   
    public function index(Request $request)
    {   
        

        $products= Product::orderBy('name','ASC')->where('status','=','Activo')->paginate(12);
        $idproducts=[];
        return view('main.pagine.Catalogo.Catalogue')->with('products',$products)
                                                     ->with('idproducts',$idproducts);
    }

public function show($id)
    {
        $product=Product::find($id);
         return view('main.pagine.Catalogo.showProduct')->with('product', $product);
    }

 public function filtro($name){
    $event= Event::searchEvent($name)->first();
    $categories=DB::table('event_product as pe')
      ->join('products as p','pe.product_id','=','p.id')
      ->join('categories as c','c.id','=','p.category_id')
      ->select('c.id','c.name','c.extension')
      ->where('pe.event_id','=',$event->id)->distinct()->get();

   
 	  return view('main.pagine.Catalogo.filtroCategoriaCatalogo')
          ->with('categories',$categories)
 					->with('name',$name);

} 

public function searchCategoryProduct($idCategory,$nameEvents){


     $events=Event::SearchEvent($nameEvents)->first();
    
     $products=$events->productsC($idCategory)->paginate(12);

  
  
      return view('main.pagine.Catalogo.Catalogue')->with('products',$products);
}



   
  } 

