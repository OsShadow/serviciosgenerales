<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmergenciesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'head' => 'Encabezado',
            'description' => 'Descripcion',
            'observations' => 'Observaciones'
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
            'head' => 'required',
            'description' => 'required',
            'observations' => 'required'
        ];
    }
}
