<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'first_name' => 'required',
            'second_name' => '',
            'third_name' => '',
            'first_surname' => 'required',
            'second_surname' => '',
            'third_surname' => '',
            'sex' => '',
            'birth_date' => '',
            'address' => '',
            'house_num' => '',
            'street' => '',
            'canton' => '',
            'hamlet' => '',
            'municipal_district_id' => '',
            'marital_status' => '',
            'nationality' => '',
            'cellphone' => '',
            'phone' => '',
            'email' => '',
            'blood_type' => '',
            'occupation' => '',
            'dui' => '',
            'nit' => '',
            'photo' => '',
            'conversion_date' => '',
            'status' => 'required',
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
