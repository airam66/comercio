<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\WebUserRequest;
use App\User;
use App\Role;
use App\Client;

class UserWebController extends Controller
{

  public function index(Request $request){

    $users=User::searchUserName($request->name)->where('role_id','=',5)->orderBy('name')->paginate('15');
   return view('admin.users.indexUsersWeb')->with('users',$users);
  }

   public function edit(){
    $user=\Auth::user();
    $client=Client::find($user->client_id);
    return view('main.pagine.webUsers.edit')->with('user',$user)->with('client',$client);
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
    $client=Client::find($user->client_id);
    $client->fill($request->all());

    $client->save();
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
