<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoomStay as RoomStayResource;

class Reservation extends JsonResource
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
            'comments' => $this->comments,
            'owner_name' => $this->owner_name,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'total_due' => $this->total_due,
            'currency' => $this->currency,
            'room_stays' => RoomStayResource::collection($this->whenLoaded('roomStays')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
