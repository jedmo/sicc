<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'total_attendance' => $this->total_attendance,
            'total_adult_attendance' => $this->total_adult_attendance,
            'total_youth_attendance' => $this->total_youth_attendance,
            'total_children_attendance' => $this->total_children_attendance,
        ];
    }
}
