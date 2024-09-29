<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StepEnum;

class Tracking extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'step' => StepEnum::class,
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
