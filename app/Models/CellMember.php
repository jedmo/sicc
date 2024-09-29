<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CellMember extends Model
{
    use HasFactory;

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function address()
    {
        return $this->hasOneThrough(Address::class, Member::class, 'cell_member_id', 'id', 'id', 'member_id');
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->member->birth_date)->age;
    }

    protected $appends = [
        'full_name',
    ];

    protected $casts = [
        'full_name' => 'string',
    ];
    public function getFullNameAttribute()
    {
        if ($this->member) {
            $first_name = $this->member->first_name ?? '';
            $second_name = $this->member->second_name ?? '';
            $third_name = $this->member->third_name ?? '';
            $first_surname = $this->member->first_surname ?? '';
            $second_surname = $this->member->second_surname ?? '';
            $third_surname = $this->member->third_surname ?? '';

            return trim($first_name . ' ' . $second_name . ' ' . $third_name . ' ' . $first_surname . ' ' . $second_surname . ' ' . $third_surname);

        } else {
            return null; // or some default value, e.g. 'Unknown'
        }
    }

}
