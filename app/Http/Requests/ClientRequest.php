<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Client;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'max:120|required',
            'cuil'=> 'max:11|min:11|unique:clients',
            'location'=>'required',
            'address'=>'required',
            'email'=>'unique:clients',
            'phone'=>'max:15|min:7|required',
        ];
    }
}
