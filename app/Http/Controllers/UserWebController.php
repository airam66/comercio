<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\WebUserRequest;
use App\User;
use App\Role;

class UserWebController extends Controller
{
  protected function create(){

   $locations= array('Rosario de Lerma', 'Salta');
   	return view('admin.users.register')->with('locations',$locations);
   }

 protected function store(Request $request){

 
    
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
     
    $role=Role::where('name','=','Standard');
    dd($role);
    $user->save();
     return redirect()->route('index');

      

   }


   public function edit(){

    return view('main.pagine.webUsers.edit');
   }

    public function changeDatas(WebUserRequest $request){

   $user=\Auth::user();
    $user->fill($request->all());
    $user->password=bcrypt($request->newpassword);
      if($request->file('photo')){
                 $file =$request->file('photo');
                 $name=$file->getClientOriginalName();
                 if ($name!=$user->photo_name){
                       $path=public_path().'/images/users/';
                       $file->move($path,$name);
                      $user->photo_name=$name;
                    }
          }

    $user->save();
    flash("Sus datos se cambiaron correctamente ", 'success')->important();
     
       return redirect()->route('webUsers.edit');
   
   }

  public function changePassword(ChangePasswordRequest $request){
    $user=\Auth::user();
     $user->password=bcrypt($request->newpassword);
     $user->save();
    flash("Su contraseña se ha cambiado correctamente ", 'success')->important();
     
       return redirect()->route('webUsers.edit');
   }


    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back();
    }
   
}
