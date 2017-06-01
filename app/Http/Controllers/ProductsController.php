<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Brand;
use App\Line;
use App\Event;
use App\ProductPrice;

class ProductsController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products= Product::orderBy('name','ASC')->paginate(5);
              

        return view('admin.products.index')->with('products',$products);


    }

    public function create()
    {   

        $categories= Category::orderBy('name','ASC')->pluck('name','id');
        $lines=Line::orderBy('name','ASC')->pluck('name','id');
        $brands=Brand::orderBy('name','ASC')->pluck('name','id');
        $events=Event::orderBy('name','ASC')->pluck('name','id');

        return view('admin.products.create')->with('categories',$categories)
                                            ->with('lines',$lines)
                                            ->with('brands',$brands)
                                            ->with('events',$events);
       
    }

    
    public function store(Request $request)
    {
       $this->validate($request,[

          'name'=> 'max:100|required|unique:products',
          'code'=> 'max:8|min:8|unique:products',
          'category_id'=>'required|exists:categories,id',
          'price'=>'required',
          'stock'=>'required',

        ]);

        $products= new Product($request->all());

         if($request->file('image')){
                 $file =$request->file('image');
                 $extension=$file->getClientOriginalName();
                 $path=public_path().'/images/products/';
                 $file->move($path,$extension);
                $products->extension=$extension;
                }
         

        $products->status=$request->status;
        $products->category_id= $request->category_id;
        $products->line_id= $request->line_id;
        $products->brand_id= $request->brand_id;
        $products->event_id= $request->event_id;

         //$hasFile=$request->hasFile('image') && $request->image->isValid();
         /**If($hasFile){
            $extension=$request->image->extension();
            $products->extension=$extension;
         }

       if($products->save()){

         if ($hasFile){
            $request->image->storeAs('images',"$products->id.$extension");

         
         return redirect()->route('products');
         }else {
            return view('admin.products.create',['products'=>$products]);

         }
       }**/

       $products->save();

        //carga de lista de precios
    //    $products=Product::all();
      // var_dump($products->last());
        $productprice= new ProductPrice();
        $productprice->products_id=$products->id;
        $productprice->purchase_price=$request->price;
        $productprice->wholesale_price=$request->price;//falta ajustar con el porcentaje
        $productprice->retail_price=$request->price;//jsuatar con el procentaje
        $productprice->save();

       return redirect()->route('products.index');

    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}

