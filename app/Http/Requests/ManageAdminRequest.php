<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageAdminRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validation_array = [
            'name' => 'required|string',
            'contact' => 'required|min:7|max:10',
            'role_id' => 'required|numeric',
        ];

        if(request()->isMethod('put')){
            $validation_array['email'] = 'required|email|unique:admins,email,'.request()->id;
        }else{
            $validation_array['password'] = 'required|min:8';
            $validation_array['email'] = $validation_array['email'] = 'required|email|unique:admins,email';
        }

        return $validation_array;
    }
}
