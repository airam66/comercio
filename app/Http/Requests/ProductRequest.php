<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Product;

class ProductRequest extends FormRequest
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
          'name'=> 'max:100|required|unique:products',
          'code'=> 'max:20|min:3|unique:products',
          'category_id'=>'required|exists:categories,id',
          'line_id'=>'required|exists:lines,id',
          'brand_id'=>'required|exists:brands,id',
          'description'=>'required',
          'stock'=>'required',
          'retail_price'=>'required',
          'purchase_price'=>'required',        
          'image'=>'required',
          'wholesale_cant'=>'required'
        ];
    }
}
