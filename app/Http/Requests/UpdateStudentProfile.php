<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentProfile extends FormRequest
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
        $student = $this->student;
        return [
            'name' => ['required', 'max:50', Rule::unique('students')->ignore($student)],
            'dni' => ['required', Rule::unique('students')->ignore($student)],
            'cuil' => 'nullable|max:13|min:11',
            'address' => 'required',
            'fnac' => 'required|date',
            'phone' => 'required',
            'email' => 'nullable',
            'user_id' => 'required',
            'docket' => ['nullable', Rule::unique('students')->ignore($student)],
            'photo' => 'nullable|file|mimes:jpg,jpeg,png',
            'file' => 'nullable|file|mimes:jpg,jpeg,png',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation'
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'Las contraseñas no coinciden'
        ];
    }
}
