<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageMenuRequest extends FormRequest
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
            'menu_name' => 'required|alpha',
            'parent_id' => 'numeric|required',
            'menu_icon' => 'required|string',
            'menu_href' => 'required|string',
            'permission.*' => 'required|between:0,4',
        ];
    }
}