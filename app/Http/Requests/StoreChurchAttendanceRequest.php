<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChurchAttendanceRequest extends FormRequest
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
            'start_date' => 'required',
            'end_date' => 'required',
            'sibling_attendance_1d' => '',
            'friends_attendance_1d' => '',
            'total_attendance_1d' => '',
            'sibling_attendance_2d' => '',
            'friends_attendance_2d' => '',
            'total_attendance_2d' => '',
            'sibling_attendance_sd' => '',
            'friends_attendance_sd' => '',
            'total_attendance_sd' => '',
            'total_attendance_week' => '',
            'user_id' => '',
            'cell_id' => 'required'
        ];
    }
}
