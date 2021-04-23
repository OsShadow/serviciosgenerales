<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'date_start' => 'Fecha de salida',
            'hour_start' => 'Hora de salida',
            'km_start' => 'Kilometro de salida',
            'driver' => 'Chofer',
            'vehicle' => 'Vehiculo'
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
            'date_start' => 'required|max:255',
            'hour_start' => 'required|max:255',
            'km_start' => 'required|numeric',
            'driver' => 'required|max:255',
            'vehicle' => 'required|numeric'
        ];
    }
}
