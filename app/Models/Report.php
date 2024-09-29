<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->adult_sibling_attendance = $model->adult_sibling_attendance ?? 0;
            $model->adult_friends_attendance = $model->adult_friends_attendance ?? 0;
            $model->total_adult_attendance = $model->total_adult_attendance ?? 0;
            $model->youth_sibling_attendance = $model->youth_sibling_attendance ?? 0;
            $model->youth_friends_attendance = $model->youth_friends_attendance ?? 0;
            $model->total_youth_attendance = $model->total_youth_attendance ?? 0;
            $model->children_sibling_attendance = $model->children_sibling_attendance ?? 0;
            $model->children_friends_attendance = $model->children_friends_attendance ?? 0;
            $model->total_children_attendance = $model->total_children_attendance ?? 0;
            $model->total_attendance = $model->total_attendance ?? 0;
            $model->conversions = $model->conversions ?? 0;
            $model->reconciliations = $model->reconciliations ?? 0;
            $model->programmed_visits = $model->programmed_visits ?? 0;
            $model->water_baptisms = $model->water_baptisms ?? 0;
            $model->church_offering = $model->church_offering ?? 0.00;
            $model->offering_meter_by_meter = $model->offering_meter_by_meter ?? 0.00;
            $model->pro_bus_offering = $model->pro_bus_offering ?? 0.00;
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

    public function attendance()
    {
        return $this->hasOne(CellAttendance::class);
    }
}
