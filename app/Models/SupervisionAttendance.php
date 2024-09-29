<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisionAttendance extends Model
{
    use HasFactory;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->member_attendance = [];
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
