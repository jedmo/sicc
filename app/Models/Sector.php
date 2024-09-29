<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function cell()
    {
        return $this->hasOne(Cell::class);
    }

    public function member()
    {
        return $this->hasOneThrough(Member::class, User::class, 'id', 'id', 'user_id', 'member_id');
    }
}
