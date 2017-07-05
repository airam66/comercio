<?php

namespace App\Http\Controllers;// para que este como dentro de una carpeta

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Carrusel;


class MainController extends Controller{
 
 public function index(){
   	 $imagenes=Carrusel::all();
   	
  return view('main.pagine.index')->with('imagenes',$imagenes);   //crear una vista dentro de la carpeta main q se llame home.

}


}

?>