<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation represents all the reservations in the system.
 *
 * @package App\Models
 * @property $id
 * @property $unique_id
 * @property $comments
 * @property $status
 * @property $owner_name
 * @property $total_amount
 * @property $total_due
 * @property $currency
 * @property $created_at
 * @property $updated_at
 * @method static whereUniqueId($reservationId)
 * @method static whereGuestEmail($email)
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

    /**
     * Set guest status to arrived.
     */
    public function checkin()
    {
        $this->status = 'Checked-in';
        $this->save();
    }

    /**
     * Local query for reservation via unique id.
     *
     * @param Builder $query
     * @param $reservationId
     * @return Builder
     */
    public static function scopeWhereUniqueId(Builder $query, $reservationId)
    {
        return $query->where('unique_id', $reservationId);
    }

    /**
     * Local query for reservation via guest's email.
     *
     * @param Builder $query
     * @param $email
     * @return Builder
     */
    public static function scopeWhereGuestEmail(Builder $query, $email)
    {
        return $query->whereHas('guests', static function ($q) use ($email) {
            return $q->where('email', $email);
        });
    }

    /**
     * Create a new reservation.
     *
     * @param array $attributes
     * @return Reservation
     */
    public static function create(array $attributes)
    {
        $reservation = new self();
        $reservation->comments = '';
        $reservation->owner_name = $attributes['first_name'] . " " . $attributes['last_name'];
        $reservation->total_amount = 388.89;
        $reservation->total_due = 388.89;
        $reservation->currency = 'EUR';
        $reservation->created_at = now();
        $reservation->updated_at = now();
        $reservation->save();

        $attributes['reservation_id'] = $reservation->id;

        $roomStay = RoomStay::create($attributes);

        $attributes['room_stay_id'] = $roomStay->id;

        Guest::create($attributes);

        return $reservation;
    }
}
