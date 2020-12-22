<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Room represents all the rooms available in the system.
 *
 * @package App\Models
 * @property $id
 * @property $unique_id
 * @property $name
 * @property $description
 * @property $available_from
 * @property $available_to
 * @property $is_published
 * @property $location
 * @property $created_at
 * @property $updated_at
 */
class Room extends Model
{
    use HasFactory;

    /**
     * Relationship with the RoomType model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Relationship with the RoomImage model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }

    /**
     * Relationship with the RoomStay model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roomStays()
    {
        return $this->belongsToMany(RoomStay::class);
    }
}
