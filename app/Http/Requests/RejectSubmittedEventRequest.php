<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RejectSubmittedEventRequest extends FormRequest
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
            'cancel_statement' => 'required|max:50',
            'cancel_statement' => 'required|min:5',
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
            'cancel_statement.max' => 'Argumen penolakan event maksimal 50 kata',
            'cancel_statement.min' => 'Argumen penolakan event minimal 5 kata',
        ];
    }
}
