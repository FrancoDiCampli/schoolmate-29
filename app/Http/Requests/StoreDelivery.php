<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDelivery extends FormRequest
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
            'link' => 'nullable|regex:/^.+youtu.+$/i',
            'file' => 'nullable|file|mimes:pdf,xlsx,pptx,docx',
            'fotos*' => 'nullable|file|mimes:jpg,jpeg,png',
            'video' => 'nullable|file|mimes:mov,mpeg4,mp4,avi,wmv,mpegps,flv,3gpp,webm,dnxhr,hevc',
        ];
    }
}
