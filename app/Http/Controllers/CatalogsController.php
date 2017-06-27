<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
        
        return view('main.pagine.Catalogo.Catalogue')->with('products',$products);
    }

public function show($id)
    {
        $product=Product::find($id);
         return view('main.pagine.Catalogo.showProduct')->with('product', $product);
    }

 public function filtro($name){
    $event= Event::searchEvent($name)->first();
    $products= $event->products()->paginate(5);
     $i=0;
    foreach ($products as $product) {
      
     $categories1[$i]=Category::SearchCategory($product->category_id)->first();
     $i=$i+1;
    }

  $categories= array_values(array_unique($categories1));
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

