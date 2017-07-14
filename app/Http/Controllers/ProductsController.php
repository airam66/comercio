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
        $categories=Category::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        $lines=Line::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        $brands=Brand::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        $events=Event::where('status','=','activo')->orderBy('name','ASC')->pluck('name','id')->ToArray();
        $route=redirect()->back()->getTargetUrl();
        

        if (empty($porcentage->wholesale_porcentage)){
                return redirect()->route('products.index');
        }else{
        return view('admin.products.create')->with('categories',$categories)
                                            ->with('lines',$lines)
                                            ->with('brands',$brands)
                                            ->with('events',$events)
                                            ->with('porcentage',$porcentage)
                                            ->with('route',$route);

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

        $products->code=$request->code;
        $products->status=$request->status;
        $products->category_id= $request->category_id;
        $products->line_id= $request->line_id;
        $products->brand_id= $request->brand_id;

        $products->save();

        $products->event()->sync($request->events);

        return redirect()->to($request->route);

    }

    public function SearchEventProducts(Request $request){
       $event= Event::searchEventP($request->Evento)->first();
        $validacion=false;
      if(($event!=null )&&($request->Evento!="")){
         
          $products= $event->products()->get();
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
          'line_id'=>'required|exists:lines,id',
          'brand_id'=>'required|exists:brands,id',
          'stock'=>'required',
          'wholesale_cant'=>'required',
        ]);

        $products= Product::find($id);

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
      
      //*****************PARA ACTUALIZAR STOCK DE PRODUCTOS PERSONALIZADOS*************

      
      public function searchCraft(Request $request){
      // BUSCADOR DE PRODUCTOS MARCA CREATU POR NOMBRE DEL PRODUCTO
   
      if($request->ajax()){
        $output="";
        $comilla="'";
      $brand=Brand::where('name','=','CreaTu')->pluck('id');
      $products=Product::where('brand_id','=',$brand)
                      ->where('name','LIKE',"%" . $request->search . "%")
                      ->where('status','=','activo')->get();
       if ($products) {
        foreach ($products as $key => $product) {

                  $output.='<tr>'.
                        
                        '<td>'.$product->name.'</td>'.
                        '<td> $ '.$product->retail_price.'</td>'.
                        '<td> $ '.$product->wholesale_price.'</td>'.
                        '<td>'.$product->stock.'</td>'.

                        '<td><a onclick="complete('.$product->id.','.$comilla.$product->code.$comilla.','.$comilla.$product->name.$comilla.','.$product->wholesale_price.','.$product->retail_price.','.$product->stock.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return Response($output);
          
       }        
   
    }
    }
    
       public function searchCraftProducts(Request $request){
        //BUSCADOR DE PRODUCTOS MARCA CREATU POR LETRAS
      
            if($request->ajax()){
              $output="";
              $comilla="'";
              $brand=Brand::where('name','=','CreaTu')->pluck('id');
              $products=Product::where('brand_id','=',$brand)
                                ->where('name','LIKE', $request->searchL . "%")
                                ->where('status','=','activo')->get();
        
          
               if ($products) {
                foreach ($products as $key => $product) {
                          $output.='<tr>'.
                                 '<td>'.$product->name.'</td>'.
                                '<td>$ '.$product->retail_price.'</td>'.
                                '<td>$ '.$product->wholesale_price.'</td>'.
                                '<td>'.$product->stock.'</td>'.
                                
                                '<td><a onclick="complete('.$product->id.','.$comilla.$product->code.$comilla.','.$comilla.$product->name.$comilla.','.$product->wholesale_price.','.$product->retail_price.','.$product->stock.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                            .'</tr>';
                }

   
        return Response($output);
          
          }        
   
       }
    }

    public function craftProducts(){
       $brand=Brand::where('name','=','CreaTu')->pluck('id');
      $products=Product::where('brand_id','=',$brand)
                      ->where('status','=','activo')->get();

      return view('admin.products.craftProducts')->with('products',$products);
    }
    
    public function updateStock(Request $request){

      $this->validate($request,[
          'code'=>'required|exists:products,code',
          'amount'=>'required',
          
          
        ]);
        $product= Product::find($request->id);
        //dd($request);
        $product->stock=$request->amount + $product->stock;
        $product->save();
        flash("El stock del producto ". $product->name . " ha sido actualizado con éxito" , 'success')->important();
        return redirect()->route('craftProducts');


      
    }

    //*********************************************************************************************
   
}

