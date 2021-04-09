<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleCompleteReportRequest extends FormRequest
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
            'date_end' => 'Fecha de llegada',
            'hour_end' => 'Hora de llegada',
            'km_end' => 'Kilometro de llegada',
            'driver' => 'Chofer',
            'gas_recharge' => 'Recarga de gas'
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
            'date_end' => 'required|max:255',
            'hour_end' => 'required|max:255',
            'km_end' => 'required|numeric',
            'gas_recharge' => 'required|numeric',
            'driver' => 'required|max:255'
        ];
    }
}
