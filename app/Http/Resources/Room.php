<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoomImage as RoomImageResource;
use App\Http\Resources\RoomType as RoomTypeResource;

class Room extends JsonResource
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
            'unique_id' => $this->unique_id,
            'name' => $this->name,
            'description' => $this->description,
            'interior_size' => $this->interior_size,
            'max_occupancy' => $this->max_occupancy,
            'min_occupancy' => $this->min_occupancy,
            'available_from' => $this->available_from,
            'available_to' => $this->available_to,
            'is_published' => $this->is_published,
            'location' => $this->location,
            'room_images' => RoomImageResource::collection($this->whenLoaded('roomImages')),
            'room_type' => RoomTypeResource::make($this->whenLoaded('roomType')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
