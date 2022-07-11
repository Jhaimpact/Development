<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecategoryRequest extends FormRequest
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
        $validation_array =  [
            'name' => 'required|alpha',
            'parent' => 'numeric|nullable',
            'status' => 'boolean',
        ];

        if(request()->isMethod('post')){
            $validation_array['category_icon'] = 'required';
            $validation_array['category_image'] = 'required';
        }

        return $validation_array;
    }
}