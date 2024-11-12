<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellInitialData extends Model
{
    use HasFactory;

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
