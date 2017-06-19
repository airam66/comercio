<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\Brand;
use App\Line;
use App\Event;
use App\EventProduct;
use App\Porcentage;

class ProductsController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
       
        $porcentage=Porcentage::all()->last();
        if (empty($porcentage->wholesale_porcentage)){
                flash("Cargar variables de porcentaje para la venta mayor y menor" , 'danger')->important();
        }
        

        $products=Product::SearchProduct($request->name)->orderBy('name','ASC')->get();
      
        $validacion=false;

       if(count($products)==0){

        $validacion=true;
        $products=Product::all();
       }
      
        return view('admin.products.index')->with('products',$products)
                                           ->with('validacion',$validacion);

                                          
    

    }

    public function create()
    {   
        $porcentage=Porcentage::all()->last();
        $categories= Category::orderBy('name','ASC')->pluck('name','id');
        $lines=Line::orderBy('name','ASC')->pluck('name','id');
        $brands=Brand::orderBy('name','ASC')->pluck('name','id');
        $events=Event::orderBy('name','ASC')->pluck('name','id');

        if (empty($porcentage->wholesale_porcentage)){
                return redirect()->route('products.index');
        }else{
        return view('admin.products.create')->with('categories',$categories)
                                            ->with('lines',$lines)
                                            ->with('brands',$brands)
                                            ->with('events',$events)
                                            ->with('porcentage',$porcentage);

    }

    }
    public function store(ProductRequest $request)
    {

        $products= new Product($request->all());
         if($request->file('image')){
                 $file =$request->file('image');
                 $extension=$file->getClientOriginalName();
                 $path=public_path().'/images/products/';
                 $file->move($path,$extension);
                $products->extension=$extension;
                }

        $request->code=$products->newCode($request->category_id,$request->code);

        $this->validate($request,[
             'code'=> 'unique:products',  
        ]);
        
        
        $products->code=$request->code;
        $products->status=$request->status;
        $products->category_id= $request->category_id;
        $products->line_id= $request->line_id;
        $products->brand_id= $request->brand_id;

        $products->save();

        $products->event()->sync($request->events);

       return redirect()->route('products.index');

    }

    public function SearchEventProducts(Request $request){
       $event= Event::searchEventP($request->Evento)->first();
        $validacion=false;
      if(($event!=null )&&($request->Evento!="")){
         
          $products= $event->products();
          return view('admin.products.index')->with('products',$products)
                                            ->with('validacion',$validacion);
        }
      $products=Product::SearchProduct($request->name)->orderBy('name','ASC')->get();  
      if ($event==null) {
            $validacion=true;
            }                                          
       
        return view('admin.products.index')->with('products',$products)
                                           ->with('validacion',$validacion);
    
    
        }

     
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {   $product= Product::find($id);
        $product->code=$product->singleCode($product->code);
        $categories= Category::orderBy('name','ASC')->pluck('name','id');
        $lines=Line::orderBy('name','ASC')->pluck('name','id');
        $brands=Brand::orderBy('name','ASC')->pluck('name','id');
        $events=Event::orderBy('name','ASC')->pluck('name','id');
        $porcentage=Porcentage::all()->last();
        $productEvent=$product->event->pluck('id')->ToArray();   

        return view('admin.products.edit')->with('product',$product)
                                            ->with('categories',$categories)
                                            ->with('lines',$lines)
                                            ->with('brands',$brands)
                                            ->with('events',$events)
                                            ->with('porcentage',$porcentage)
                                            ->with('productEvent',$productEvent);

    }

   
    public function update(Request $request, $id)
    {

      $this->validate($request,[
          'category_id'=>'required|exists:categories,id',
          'line_id'=>'required|exists:lines,id',
          'brand_id'=>'required|exists:brands,id',
          'stock'=>'required',
          'wholesale_cant'=>'required',
        ]);

        $products= Product::find($id);

        if($request->code!=$products->code){
          $this->validate($request,['code'=> 'max:20|min:3|unique:products',]);
        }

        $products->fill($request->all());


         if($request->file('image')){
                 $file =$request->file('image');
                 $extension=$file->getClientOriginalName();
                 if ($extension!=$products->extension){
                       $path=public_path().'/images/products/';
                       $file->move($path,$extension);
                      $products->extension=$extension;
                    }
          }

        $products->code=$products->newCode($request->category_id,$request->code);
        $products->category_id= $request->category_id;
        $products->line_id= $request->line_id;
        $products->brand_id= $request->brand_id;
        $products->save();
       return redirect()->route('products.index');
    }

    public function desable($id)
    {
        $product= Product::find($id);
        $product->status='inactivo';
        $product->save();
        return redirect()->route('products.index');
    }

    public function enable($id)
    {
        $product= Product::find($id);
        $product->status='activo';
        $product->save();
        return redirect()->route('products.index');
    }

        public function destroy($id)
    {
           $product= Product::find($id);
           $products->delete();
        return redirect()->route('products.index');
    }

   
}

