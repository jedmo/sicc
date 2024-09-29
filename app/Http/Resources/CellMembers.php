<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CellMembers extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $first_name = $this->member->first_name ?? '';
        $second_name = $this->member->second_name ?? '';
        $third_name = $this->member->third_name ?? '';
        $first_surname = $this->member->first_surname ?? '';
        $second_surname = $this->member->second_surname ?? '';
        $third_surname = $this->member->third_surname ?? '';

        return [
            'id' => $this->id,
            'member_id' => $this->member_id,
            'member_name' => trim($first_name . ' ' . $second_name . ' ' . $third_name . ' ' . $first_surname . ' ' . $second_surname . ' ' . $third_surname),
            'member_age' => Carbon::parse($this->member->birth_date)->age,
        ];
    }
}
