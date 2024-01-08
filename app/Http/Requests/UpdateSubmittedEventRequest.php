<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubmittedEventRequest extends FormRequest
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
        return [
            'organizer_name' => 'required|max:50',
            'PIC_email' => 'required|email|max:50',
            'PIC_phone' => 'required|max:15',
            'title' => 'required|max:50',
            'description' => 'required|max:2000',
            'is_online' => 'required|boolean',
            'is_publish' => 'required|boolean',
            'type' => 'required',
            'location' => 'required|max:200',
            'potrait_banner' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'landscape_banner' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'start_date' => 'nullable',
            'total_day' => 'integer|min:1',
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'potrait_banner.mimes' => 'file type must jpg or png',
            'landscape_banner.mimes' => 'file type must jpg or png',
            'potrait_banner.max' => 'maximum file size 1mb',
            'landscape_banner.max' => 'maximum file size 1mb',
        ];
    }
}
