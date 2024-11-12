<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorInitialData extends Model
{
    use HasFactory;

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
