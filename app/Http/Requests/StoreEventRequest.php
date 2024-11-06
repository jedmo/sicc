<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'place' => '',
            'image' => '',
            'description' => '',
            'user_id' => '',
            'zone_id' => '',
            'district_id' => ''
        ];
    }
}
