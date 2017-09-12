<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'cuil'=>'required|numeric',
            'phone'=>'required|numeric',
            'address'=>'required|max:250',
            'location'=>'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        $Client=Client::clientByCuil($data['cuil']);

        if (empty($Client[0]->id)) {
           $Client=Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cuil'=>$data['cuil'],
            'address'=>$data['address'],
            'phone'=>$data['phone'],
            'location'=>$data['location'],
            'bill'=>0,
        ]);
        }else{
            $Client=Client::find($Client[0]->id);
            $Client->name=$data['name'];
            $Client->email=$data['email'];
            $Client->address=$data['address'];
            $Client->phone=$data['phone'];
            $Client->location=$data['location'];
            $Client->save();
        }
        


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'photo_name'=>'profile.jpg',
            'role_id'=>5,
            'client_id'=>$Client->id,
        ]);



    }
}
