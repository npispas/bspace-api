<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Guest represents all the available guests in the system connected to a reservation.
 *
 * @package App\Models
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $created_at
 * @property $updated_at
 */
class Guest extends Model
{
    use HasFactory;

    /**
     * Relationship with the Reservation model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Relationship with the RoomStay model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roomStay()
    {
        return $this->belongsTo(RoomStay::class);
    }

    /**
     * Relationship with the GuestImage model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function guestImage()
    {
        return $this->hasOne(GuestImage::class);
    }
}
