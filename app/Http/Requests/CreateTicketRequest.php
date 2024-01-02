<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
            'name.*' => 'required|max:50',
            'date.*' => 'required|max:14',
            'ticket_price.*' => 'required|integer|min:0',
            'quantity.*' => 'required|integer|min:1',
            'is_all_day_pass' => 'required|boolean',
            'event_id' => 'required|integer|min:1',
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
            'name.required' => 'ticket name are required',
            'name.max' => 'ticket name maximal 50 character',
            'ticket_price.integer' => 'ticket price must integer',
            'ticket_price.min' => 'minimum price are 0',
            'quantity.min' => 'minimum ticket quantity are 1',
        ];
    }
}
