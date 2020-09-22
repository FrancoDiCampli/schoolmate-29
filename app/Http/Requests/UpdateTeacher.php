<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacher extends FormRequest
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
        $teacher = $this->teacher;

        return [
            'name' => ['required', 'max:50', Rule::unique('teachers')->ignore($teacher)],
            'dni' => ['required', Rule::unique('teachers')->ignore($teacher)],
            'cuil' => 'nullable|max:11|min:11',
            'address' => 'required',
            'fnac' => 'string',
            'phone' => 'required',
            'email' => 'required',
            'user_id' => 'required',
            'docket' => ['nullable', Rule::unique('teachers')->ignore($teacher)],
            'photo' => 'nullable|file|mimes:jpg,jpeg,png',
            'file' => 'nullable|file|mimes:jpg,jpeg,png',
        ];
    }
}
