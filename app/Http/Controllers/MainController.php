<?php

namespace App\Http\Controllers;// para que este como dentro de una carpeta

use Illuminate\Http\Request;

use App\Http\Requests;


class MainController extends Controller{
 
   public function home(){
  return view('main.pagine.home',[]);   //crear una vista dentro de la carpeta main q se llame home.

}


public function homeCon(){
  return view('main.pagine.homeCon',[]);   //crear una vista dentro de la carpeta main q se llame home.

}
}

?>