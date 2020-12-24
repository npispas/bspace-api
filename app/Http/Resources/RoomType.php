<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomType extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'max_occupancy' => $this->max_occupance,
            'min_occupancy' => $this->min_occupancy,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
