<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WaterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'date' => 'Fecha',
            'read' => 'Lectura',
            'hour' => 'Hora ',
            'cloration' => 'Cloración'
        ];
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
            'read' => 'required|max:255',
            'hour' => 'required|max:255',
            'cloration' => 'required|numeric'
        ];
    }
}
