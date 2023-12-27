<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'is_online' => 'required|boolean',
            'location' => 'required|max:200',
            'potrait_banner' => 'nullable|mimes:jpg,png',
            'landscape_banner' => 'nullable|mimes:jpg,png|max:1024',
            'capacity' => 'required|integer'
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
