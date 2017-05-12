<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cotillon;

class MainPagineController extends Controller
{

	public function index(){


	}


	public function create(){
    
    return view('cotillon.create');

	}

	public function store(Request $request){

		 $cotillon= new Cotillon($request->all());
		 $cotillon->business_hours= $request->business_hours;
         $cotillon->save();

       return redirect()->route('home');

     

	}
}
