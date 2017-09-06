<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Category;
use App\Product;
use App\Brand;
use App\Line;
use App\Event;
use App\EventProduct;
use App\Porcentage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection as Collection;

class ProductsController extends Controller
{
    
    public function index(Request $request)
    {
       
        $porcentage=Porcentage::all()->last();
        if (empty($porcentage->wholesale_porcentage)){
                flash("Cargar variables de porcentaje para la venta mayor y menor" , 'danger')->important();
        }
        

       $products=Product::SearchProduct($request->name)->orderBy('name','ASC')->paginate(10);

        $productEvent=DB::table('events as e')
                          ->join('event_product as ep','e.id','=','ep.event_id')
                          ->select('ep.event_id','e.name as event_name','ep.product_id')
                          ->get();   
         
 
          if ($request->event!=''){
               $event= Event::SearchEventP($request->event)->first();          

            if ($event != null){
               $products= $event->products()->paginate(10);
             }
             else{
       
            $products = Collection::make();
           
           }
      
        }                                           
       
      return view('admin.products.index')->with('products',$products)
                                           ->with('productEvent',$productEvent);
    
    }  



    public function create()
    {   
        $porcentage=Porcentage::all()->last();
        $categories=Category::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        $lines=Line::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        $brands=Brand::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        $events=Event::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        

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
        $products->name=strtoupper($products->name);
        $products->code=$request->code;
        $products->status=$request->status;
        $products->category_id= $request->category_id;
        $products->line_id= $request->line_id;
        $products->brand_id= $request->brand_id;

        $products->save();
        if(!empty($request->events)){

        $products->event()->sync($request->events);}

        return redirect()->route('products.index');

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
          'line_id'=>'required|exists:lines,id',
          'brand_id'=>'required|exists:brands,id',
          'stock'=>'required',
          'wholesale_cant'=>'required',
        ]);

        $products= Product::find($id);
        $id= $products->event->pluck('id');

        DB::table('event_product')->where('product_id','=',$products->id)->delete();

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

        $products->save();
         if(!empty($request->events)){

          $products->event()->sync($request->events);
        }
        

       return redirect()->route('products.index');
    }

    //*********************PARA DAR DE ALTA O BAJA UN PRODUCTO************************

    public function desable($id)
    {
        $product= Product::find($id);
        $product->status='inactivo';
        $product->save();
        return redirect()->back();
    }

    public function enable($id)
    {
        $product= Product::find($id);
        $product->status='activo';
        $product->save();
        return redirect()->back();
    }
      
      //*****************PARA ACTUALIZAR STOCK DE PRODUCTOS PERSONALIZADOS*************
      

      
      public function searchCraft(Request $request){
      // BUSCADOR DE PRODUCTOS MARCA CREATU POR NOMBRE DEL PRODUCTO
   
      if($request->ajax()){
       
      $brand=Brand::where('name','=','CREATÚ')->pluck('id');
      $products=Product::SearchProduct($request->search )
                          ->where('brand_id','=',$brand)
                          ->where('status','=','activo')->get();
       
        $result=listPopup($products);
       return Response($result);
         
       }
   
    
    }
    
       public function searchCraftProducts(Request $request){
        //BUSCADOR DE PRODUCTOS MARCA CREATU POR LETRAS
      
            if($request->ajax()){
              
              $brand=Brand::where('name','=','CREATÚ')->pluck('id');
              $products=Product::SearchProductL($request->searchL)
                                -> where('brand_id','=',$brand)
                                ->get();
         $result=listPopup($products);
         return Response($result);
   
       }
    }

    public function craftProducts(){
       $brand=Brand::where('name','=','CREATÚ')->pluck('id');
      $products=Product::where('brand_id','=',$brand)
                      ->where('status','=','activo')->orderBy('name','ASC')->get();

      return view('admin.products.craftProducts')->with('products',$products);
    }
    
    public function updateStock(Request $request){

      $this->validate($request,[
          'code'=>'required|exists:products,code',
          'amount'=>'required',
          
          
        ]);
        $product= Product::find($request->id);
        $product->stock=$request->amount + $product->stock;
        $product->save();
        flash("El stock del producto ". $product->name . " ha sido actualizado con éxito" , 'success')->important();
        return redirect()->route('craftProducts');


      
    }

    //**************************** ACTUALIZAR MATERIALES*****************************************************************

     public function updateStockCreate(){
       $brand=Brand::where('name','=','CREATÚ')->pluck('id');
       $products=Product::where('brand_id','<>',$brand)
                      ->where('status','=','activo')->orderBy('name','ASC')->get();

      return view('admin.products.updateStockCreate')->with('products',$products);
    }
    public function searchUpdateStockCreate(Request $request){
      // BUSCADOR DE PRODUCTOS MARCA CREATU POR NOMBRE DEL PRODUCTO
    
      if($request->ajax()){
        $output="";
        $comilla="'";
      $brands=Brand::where('name','=','CREATÚ')->pluck('id');
    
      $products=Product::where('brand_id','<>',$brand)
                      ->where('name','LIKE',"%" . $request->search . "%")
                      ->where('status','=','activo')->get();       
        $result=listPopup($products);
        return Response($result);
    }
    }

    public function updateStockCreateProduct(Request $request){

      $this->validate($request,[
          'code'=>'required|exists:products,code',
          'amount'=>'required',
          
          
        ]);
     
        $product= Product::find($request->product_id);
        $product->stock=$product->stock - $request->amount ;
        $product->save();
        flash("El stock del producto ". $product->name . " ha sido actualizado con éxito" , 'success')->important();
        return redirect()->route('updateStockCreate');


      
    }

     public function searchProductsCreateLetter(Request $request){
        //BUSCADOR DE PRODUCTOS  POR LETRAS
      
            if($request->ajax()){
              
              $brand=Brand::where('name','=','CREATÚ')->pluck('id');
              $products=Product::SearchProductL($request->searchL)
                                -> where('brand_id','<>',$brand)
                                ->get();
         $result=listPopup($products);
         return Response($result);
   
       }
    }
    

   
}

