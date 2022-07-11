<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateproductRequest extends FormRequest
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
            'product_name' => 'required|string',
            'sell_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'discount_type' => 'numeric|nullable',
            'discount' => 'numeric|nullable',
            'description' => 'required|string|',
            'feature_image'=>'file|image',
            'slider_image.*'=>'file|image',
            'product_status'=>'numeric',
        ];
    }
}