<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreproductRequest extends FormRequest
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
        $validation_array = 
        [
            'product_name' => 'required|string',
            'sell_price' => 'required|numeric',
            'product_description' => 'required|string',
            'return_policy_description' => 'required|string',
            'category_id' => 'required',
            'cod_policy_description' => 'required|string',
        ];

        if(request()->isMethod("post")){
            $validation_array['feature_image']='required|file|image';
        }

        return $validation_array;
    }
}