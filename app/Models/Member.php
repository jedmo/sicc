<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Member extends Model
{
    use HasFactory;

    public function cell()
    {
        return $this->hasOne(CellMember::class);
    }

    public function tracking()
    {
        return $this->hasMany(Tracking::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getFullNameAttribute()
    {
        $first_name = $this->first_name ?? '';
        $second_name = $this->second_name ?? '';
        $third_name = $this->third_name ?? '';
        $first_surname = $this->first_surname ?? '';
        $second_surname = $this->second_surname ?? '';
        $third_surname = $this->third_surname ?? '';

        return trim($first_name . ' ' . $second_name . ' ' . $third_name . ' ' . $first_surname . ' ' . $second_surname . ' ' . $third_surname);

    }
}
