<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation represents all the reservations in the system.
 *
 * @package App\Models
 * @property $id
 * @property $unique_id
 * @property $comments
 * @property $total_amount
 * @property $total_due
 * @property $currency
 * @property $created_at
 * @property $updated_at
 */
class Reservation extends Model
{
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['guest_count', 'room_count'];

    /**
     * Relationship with the RoomStay model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roomStays()
    {
        return $this->hasMany(RoomStay::class);
    }

    /**
     * Relationship with the Guest Stay model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * guest_count accessor which calculates the guest count attribute.
     *
     * @return int
     */
    public function getGuestCountAttribute()
    {
        return count($this->guests);
    }

    /**
     * room_count accessor which calculates the room count attribute.
     *
     * @return int
     */
    public function getRoomCountAttribute()
    {
        $roomCount = 0;

        foreach ($this->roomStays as $roomStay) {
            $roomCount += $roomStay->room_count;
        }

        return $roomCount;
    }
}
