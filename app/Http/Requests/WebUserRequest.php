<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class WebUserRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'cuit'=>'required|numeric',
            'phone'=>'required|numeric',
            'photo_name'=>'image',
            'location'=>'required',
            'address'=>'required',
            
          
           
        ];
    }
}