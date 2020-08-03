<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacher extends FormRequest
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
     * ['name','dni','cuil','fnac','phone','email','photo','address','docket','user_id'];
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:teachers|max:50',
            'dni' => 'required|unique:teachers',
            'address'=>'required',
            'fnac'=>'date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'phone'=>'required',
            'email'=>'required',
            'user_id'=>'unique:teachers',
            'file' => 'nullable|file|mimes:jpg,jpeg,png'
        ];
    }
}
