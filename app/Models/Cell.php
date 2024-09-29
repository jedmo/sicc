<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    public function leader()
    {
        return $this->belongsTo(CellMember::class, 'leader_id');
    }

    public function host()
    {
        return $this->belongsTo(CellMember::class, 'host_id');
    }

    public function assistant()
    {
        return $this->belongsTo(CellMember::class, 'assistant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_leader_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function zone()
    {
        return $this->hasOne(Zone::class);
    }

    protected $appends = [
        'leader_full_name',
        'host_full_name',
        'assistant_full_name',
    ];

    protected $casts = [
        'leader_full_name' => 'string',
        'host_full_name' => 'string',
        'assistant_full_name' => 'string',
    ];
    public function getLeaderFullNameAttribute()
    {
        if ($this->leader) {
            $first_name = $this->leader->first_name ?? '';
            $second_name = $this->leader->second_name ?? '';
            $third_name = $this->leader->third_name ?? '';
            $first_surname = $this->leader->first_surname ?? '';
            $second_surname = $this->leader->second_surname ?? '';
            $third_surname = $this->leader->third_surname ?? '';

            return trim($first_name . ' ' . $second_name . ' ' . $third_name . ' ' . $first_surname . ' ' . $second_surname . ' ' . $third_surname);

        } else {
            return null; // or some default value, e.g. 'Unknown'
        }
    }

    public function getHostFullNameAttribute()
    {
        if ($this->host) {
            $first_name = $this->host->first_name ?? '';
            $second_name = $this->host->second_name ?? '';
            $third_name = $this->host->third_name ?? '';
            $first_surname = $this->host->first_surname ?? '';
            $second_surname = $this->host->second_surname ?? '';
            $third_surname = $this->host->third_surname ?? '';

            return trim($first_name . ' ' . $second_name . ' ' . $third_name . ' ' . $first_surname . ' ' . $second_surname . ' ' . $third_surname);

        } else {
            return null; // or some default value, e.g. 'Unknown'
        }
    }

    public function getAssistantFullNameAttribute()
    {
        if ($this->assistant) {
            $first_name = $this->assistant->first_name ?? '';
            $second_name = $this->assistant->second_name ?? '';
            $third_name = $this->assistant->third_name ?? '';
            $first_surname = $this->assistant->first_surname ?? '';
            $second_surname = $this->assistant->second_surname ?? '';
            $third_surname = $this->assistant->third_surname ?? '';

            return trim($first_name . ' ' . $second_name . ' ' . $third_name . ' ' . $first_surname . ' ' . $second_surname . ' ' . $third_surname);

        } else {
            return null; // or some default value, e.g. 'Unknown'
        }
    }
}
