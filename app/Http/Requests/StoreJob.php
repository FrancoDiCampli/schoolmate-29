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
            'title' => 'min:5|max:40',
            'description' => 'min:20|max:30000',
            // 'link' => 'nullable|url',
            'link' => 'nullable|regex:/^.+youtu.+$/i',
            'file' => 'nullable|file|mimes:pdf,xlsx,pptx,docx,jpg,jpeg,png',
            'video' => 'nullable|file|mimes:mov,mpeg4,mp4,avi,wmv,mpegps,flv,3gpp,webm,dnxhr,hevc',
            'start' => 'date|after_or_equal:' . now()->format('d-m-Y'),
            'end' => 'date|after_or_equal:' . $this->start,
            'comment' => 'nullable|min:1|max:30000'
        ];
    }
}
