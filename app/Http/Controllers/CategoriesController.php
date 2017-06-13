<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories=Category::SearchCategory($request->name)->orderBy('name','status','ASC')->paginate(10);
       
        return view('admin.categories.index')->with('categories',$categories);
    

    }

     public function create()
    {
        return view('admin.categories.create');
    }

  
    public function store(CategoryRequest $request)
    {
       $category= new Category($request->all());


         if($request->file('image')){
                 $file =$request->file('image');
                 $extension=$file->getClientOriginalName();//nombre de img
                 $path=public_path().'/images/categories/';//donde guardamos img
                 $file->move($path,$extension);//guardar imagen
                $category->extension=$extension;
                }
                

             $category->save();
        flash("La categoria ". $category->name . " ha sido creada con exito" , 'success')->important();
     

       return redirect()->route('categories.index');
    }

   
    public function show($id)
    {
        //
    }

     
    public function edit($id)
    {     
        $category=Category::find($id);
        return view('admin.categories.edit')->with('category',$category);                                
    }

    
    public function update(Request $request, $id)
    {
        $category=Category::find($id);

        $category->fill($request->all());


         if($request->file('image')){
                 $file =$request->file('image');
                 $extension=$file->getClientOriginalName();
                 if ($extension!=$products->extension){
                       $path=public_path().'/images/products/';
                       $file->move($path,$extension);
                      $category->extension=$extension;
                    }
          }
             

        $category->save();
        flash("La categoria ". $category->name . " ha sido modificada con exito" , 'success')->important();
     

       return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        //
    }

   

}
