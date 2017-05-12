<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cotillon;

class CotillonController extends Controller
{
    //

    public function create() {
    	
    	return view ('main.cotillon.create');
    }


    public function store(Request $request){

        $cotillon= new Cotillon($request->all());
        $cotillon->business_hours=$request->business_hours;
    	$cotillon->save();


    }

}
