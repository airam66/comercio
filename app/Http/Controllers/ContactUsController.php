<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cotillon;

class ContactUsController extends Controller
{
	public function contactUs(){
	 $cotillones= Cotillon::orderBy('id','ASC')->paginate(1);
	
    return view('main.pagine.contactUs')->with('cotillones',$cotillones);
    }
}