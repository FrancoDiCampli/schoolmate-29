<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJob extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            // 'link' => 'nullable|url',
            'link' => 'nullable|regex:/^.+youtu.+$/i',
            'file' => 'nullable|file|mimes:pdf,pptx,docx,jpg,jpeg,png',
            'start' => 'date',
            'end' => 'date|after_or_equal:' . $this->start,
            'comment' => 'nullable|min:3'
        ];
    }
}
