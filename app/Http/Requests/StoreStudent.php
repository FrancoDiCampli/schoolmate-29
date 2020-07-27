<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudent extends FormRequest
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
            'name' => 'required|unique:students|max:50',
            'dni' => 'required|unique:students',
            'address'=>'required',
            'fnac'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'user_id'=>'unique:students'
        ];
    }
}
