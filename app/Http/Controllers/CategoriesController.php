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

     public function create()
    {
        return view('admin.categories.create');
    }

  
    public function store(CategoryRequest $request)
    {
       $category= new Category($request->all());
       $category->save();
        flash("La categoria ". $category->name . " ha sido creada con exito" , 'success')->important();
     

       return redirect()->route('categories.create');
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
