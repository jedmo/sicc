<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCellRequest extends FormRequest
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
            'code' => 'required',
            'full_code' => '',
            'type' => 'required',
            'day' => '',
            'hour' => '',
            'status' => 'required',
            'leader_id' => 'required',
            'host_id' => '',
            'assistant_id' => '',
            'address' => '',
            'house_num' => '',
            'street' => '',
            'canton' => '',
            'hamlet' => '',
            'municipal_district_id' => '',
            'sector_id' => '',
            'child_attendance' => '',
            'young_attendance' => '',
            'adult_attendance' => '',
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
            'user_id.required' => 'Debe seleccionar un lider',
        ];
    }
}
