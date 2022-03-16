<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
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
            'date' => 'required|max:255',
            'date_finish' => 'required',
            'hour_finish' => 'required',
            'type' => 'required',
            'ticket_report' => 'required',
            'employer' => 'required',
            'file' => 'required'
        ];
    }
}
