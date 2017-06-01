<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\Brand;
use App\Line;
use App\Event;
use App\Porcentage;

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
        $porcentage=Porcentage::all()->last();

        return view('admin.products.create')->with('categories',$categories)
                                            ->with('lines',$lines)
                                            ->with('brands',$brands)
                                            ->with('events',$events)
                                            ->with('porcentage',$porcentage);
       
    }

    
    public function store(Request $request)
    {
       $this->validate($request,[

          'name'=> 'max:100|required|unique:products',
          'code'=> 'max:20|min:3|unique:products',
          'category_id'=>'required|exists:categories,id',
          'line_id'=>'required|exists:lines,id',
          'brand_id'=>'required|exists:brands,id',
          'retail_price'=>'required',
          'purchase_price'=>'required',
          'stock'=>'required',
          'image'=>'required',
          'wholesale_cant'=>'required',
        ]);

        $products= new Product($request->all());

         if($request->file('image')){
                 $file =$request->file('image');
                 $extension=$file->getClientOriginalName();
                 $path=public_path().'/images/products/';
                 $file->move($path,$extension);
                $products->extension=$extension;
                }

        $products->code=$request->category_id+$request->code;
         
        $products->status=$request->status;
        $products->category_id= $request->category_id;
        $products->line_id= $request->line_id;
        $products->brand_id= $request->brand_id;
        $products->event_id= $request->event_id;
        $products->save();




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

