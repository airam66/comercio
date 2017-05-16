<?php

namespace App\Http\Controllers;// para que este como dentro de una carpeta

use Illuminate\Http\Request;

use App\Http\Requests;


class MainController extends Controller{
 
   public function index(){
  return view('main.pagine.index',[]);   //crear una vista dentro de la carpeta main q se llame home.

}


}

?>