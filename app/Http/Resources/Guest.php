<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Image as ImageResource;

class Guest extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'nationality' => $this->nationality,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => ImageResource::make($this->whenLoaded('image')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
