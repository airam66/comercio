<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cotillon;

class AboutUsController extends Controller
{
    public function aboutUs(){

     $cotillones= Cotillon::orderBy('id','ASC')->paginate(1);

     return view('main.pagine.aboutUs')->with('cotillones',$cotillones);
    }
}
