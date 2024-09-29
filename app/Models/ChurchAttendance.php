<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchAttendance extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->sibling_attendance_1d = $model->sibling_attendance_1d ?? 0;
            $model->friends_attendance_1d = $model->friends_attendance_1d ?? 0;
            $model->total_attendance_1d = $model->total_attendance_1d ?? 0;
            $model->sibling_attendance_2d = $model->sibling_attendance_2d ?? 0;
            $model->friends_attendance_2d = $model->friends_attendance_2d ?? 0;
            $model->total_attendance_2d = $model->total_attendance_2d ?? 0;
            $model->sibling_attendance_sd = $model->sibling_attendance_sd ?? 0;
            $model->friends_attendance_sd = $model->friends_attendance_sd ?? 0;
            $model->total_attendance_sd = $model->total_attendance_sd ?? 0;
            $model->total_attendance_week = $model->total_attendance_week ?? 0;
        });
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }
}
