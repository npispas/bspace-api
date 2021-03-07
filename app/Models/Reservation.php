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
     * Checkin a reservation.
     *
     * @param array $attributes
     * @return Reservation
     */
    public function checkin(array $attributes)
    {
        $guest = Guest::whereEmail($attributes['email'])
            ->whereFirstName($attributes['first_name'])
            ->whereLastName($attributes['last_name'])
            ->firstOrFail();

        // Update guest's profile with the registration data and set status to 'Arrived'
        $guest->update($attributes);
        $guest->saveImage($attributes['image']);
        $guest->checkin();

        $this->status = 'Checked-in';
        $this->save();

        return $this;
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
        $reservation->unique_id = uniqid('', false);
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

        if (! empty($attributes['invitations'])) {
            foreach ($attributes['invitations'] as $invitationEmail) {
                $guest = new Guest();
                $guest->unique_id = uniqid('', false);
                $guest->email = $invitationEmail;
                $guest->room_stay_id = $attributes['room_stay_id'];
                $guest->reservation_id = $attributes['reservation_id'];
                $guest->save();
            }
        }

        return $reservation;
    }

    /**
     * Update a reservation.
     *
     * @param array $attributes
     * @param array $options
     * @return Reservation
     */
    public function update(array $attributes = [], array $options = [])
    {
        $roomStay = $this->roomStays()->firstOrFail();
        $roomStay->start_date = $attributes['start_date'];
        $roomStay->start_hour = $attributes['start_hour'];
        $roomStay->end_date = $attributes['end_date'];
        $roomStay->end_hour = $attributes['start_hour'];
        $roomStay->rooms()->sync($attributes['room']);
        $roomStay->save();

        return $this;
    }
}
