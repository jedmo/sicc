<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
            'date' => 'required',
            'adult_sibling_attendance' => '',
            'adult_friends_attendance' => '',
            'total_adult_attendance' => '',
            'youth_sibling_attendance' => '',
            'youth_friends_attendance' => '',
            'total_youth_attendance' => '',
            'children_sibling_attendance' => '',
            'children_friends_attendance' => '',
            'total_children_attendance' => '',
            'total_attendance' => '',
            'conversions' => '',
            'reconciliations' => '',
            'programmed_visits' => '',
            'water_baptisms' => '',
            'church_offering' => '',
            'offering_meter_by_meter' => '',
            'pro_bus_offering' => '',
            'user_id' => '',
            'cell_id' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cell_id.required' => 'Debe seleccionar una célula',
        ];
    }
}
