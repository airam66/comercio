<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrusel;

class CarruselController extends Controller
{
   

public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
 	    $imagenes=Carrusel::all();          
        return view('admin.paginaWeb.Carrusel')->with('imagenes',$imagenes);
    }

     public function edit($id)
    {     
        $imagen=Carrusel::find($id);
        return view('admin.paginaWeb.editCarrusel')->with('imagen',$imagen);                                
    }


       
      public function update(Request $request, $id)
    {
    	

       $imagen=Carrusel::find($id);

        $imagen->fill($request->all());


         if($request->file('image')){
                 $file =$request->file('image');
                 $extension=$file->getClientOriginalName();
                 if ($extension!=$imagen->extension){
                       $path=public_path().'/images/carrusel/';
                       $file->move($path,$extension);
                      $imagen->extension=$extension;
                    }
          }
             

        $imagen->save();
        


        flash("Las imagen se hanguardado con exito" , 'success')->important();
     

       return redirect()->route('carrusel.index');
    }

}