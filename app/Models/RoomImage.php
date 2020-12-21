<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomImage represents all the rooms images available in the system.
 *
 * @package App\Models
 * @property $id
 * @property $url
 * @property $created_at
 * @property $updated_at
 */
class RoomImage extends Model
{
    use HasFactory;

    /**
     * Relationship with the Room model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
