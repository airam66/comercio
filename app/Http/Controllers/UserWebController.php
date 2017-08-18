<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;

class UserWebController extends Controller
{
  protected function create(){

   $locations= array('Rosario de Lerma', 'Salta');
   	return view('admin.users.register')->with('locations',$locations);
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
                $user->name_photo=$extension;
                }
     
   // $user->role_id=1;

    $user->save();
     return redirect()->route('index');

      

   }

}
