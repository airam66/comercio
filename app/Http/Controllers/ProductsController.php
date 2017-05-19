<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products= Product::orderBy('name','ASC')->paginate(5);
        return view('admin.products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //$categories= Category::pluck('name','id')->toArray();

        $categories= Category::orderBy('name','ASC')->pluck('name','id');

        return view('admin.products.create')->with('categories',$categories);
       
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

