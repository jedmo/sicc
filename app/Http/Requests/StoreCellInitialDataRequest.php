<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCellInitialDataRequest extends FormRequest
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
            'initial_date' => 'required',
            'child_attendance' => '',
            'young_attendance' => '',
            'adult_attendance' => '',
            'cell_id' => 'required',
            'goal_id' => 'required'
        ];
    }
}