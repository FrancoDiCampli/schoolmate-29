<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'password' => 'required_with:password_confirmation|string|min:6|max:8|confirmed',
            'current_password' => 'required',
        ];
    }
    /**
 * Configure the validator instance.
 *
 * @param  \Illuminate\Validation\Validator  $validator
 * @return void
 */
public function withValidator($validator)
{
    // checks user current password
    // before making changes
    $validator->after(function ($validator) {
        if ( !Hash::check($this->current_password, $this->user()->password) ) {
            $validator->errors()->add('current_password', 'La clave actual es incorrecta.');
        }
    });
    return;
 }
}
