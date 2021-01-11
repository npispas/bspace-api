<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomStay represents all the room stays which belong to a reservation in the system.
 *
 * @package App\Models
 * @property $id
 * @property $start_date
 * @property $start_hour
 * @property $end_date
 * @property $end_hour
 * @property $created_at
 * @property $updated_at
 */
class RoomStay extends Model
{
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['room_count', 'days'];

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
     * Relationship with the Guest model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * Relationship with the Room model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withTimestamps();
    }

    /**
     * room_count accessor which calculates the room count attribute.
     *
     * @return int
     */
    public function getRoomCountAttribute()
    {
        return count($this->rooms);
    }

    /**
     * days accessor which calculates the total days of the stay.
     *
     * @return int
     */
    public function getDaysAttribute()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->end_date);

        return $startDate->diffInDays($endDate);
    }
}
