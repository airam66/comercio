<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected function index(){

    	//return view('admin.users.create');
    }

   protected function create(){

   	return view('admin.users.create');
   }

   protected function store(UserRequest $request){

   
    
    $user=new User($request->all());
    $user->fill($request->all());
    $user->password=bcrypt($request->password);

     if($request->file('photo')){
                 $file =$request->file('photo');
                 $extension=$file->getClientOriginalName();
                 $path=public_path().'/images/users/';
                 $file->move($path,$extension);
                $users->name_photo=$extension;
                }

    $user->save();

      

   }

}
