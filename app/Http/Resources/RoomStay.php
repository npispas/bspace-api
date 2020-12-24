<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Room as RoomResource;
use App\Http\Resources\Guest as GuestResource;

class RoomStay extends JsonResource
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
            'start_date' => $this->start_date,
            'start_hour' => $this->start_hour,
            'end_date' => $this->end_date,
            'end_hour' => $this->end_hour,
            'rooms' => RoomResource::collection($this->whenLoaded('rooms')),
            'guests' => GuestResource::collection($this->whenLoaded('guests')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
