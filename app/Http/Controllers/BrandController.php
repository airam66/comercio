<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//para que este logueado
    }

     public function create()
    {
        return view('admin.brands.create');
    }

  
   public function store(Request $request)
    {
       $brand= new Event($request->all());
       $brand->save();
       flash("La marca  ". $event->name . " ha sido creada con exito" , 'success')->important();
     

       return redirect()->route('brands.create');//redirecciona la categoria
    }
}
