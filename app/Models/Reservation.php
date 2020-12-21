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
}
