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


    public function contact(){

        $msg=null;
        if(isset($_POST['contact'])){

        	$data= array(
                   'name'=>Input::get('name'),
                   'email'=>Input::get('email'),
                   'subject'=>Input::get('subject'),
                   'message'=>Input::get('message')
   
        		);

        	$fromEmail='gym.adsi@gmail.com';
        	$fromName='Administrador';

        	Mail:send('email.contact',$data,function($msg) use ($fromEmail,$fromName){

               $msg->to($fromEmail,$fromName);
               $msg=from($fromEmail,$fromName);
               $msg->subject('Nuevo email de contacto');

        	});

          $mesaje='<div class="text-info">Mensaje enviado con exito</<div>';
        }
    	return view('email.contact',array('mensaje'=>$mensaje));
    }
}