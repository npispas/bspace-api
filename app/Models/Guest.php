<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * Class Guest represents all the available guests in the system connected to a reservation.
 *
 * @package App\Models
 * @property $id
 * @property $unique_id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $nationality
 * @property $phone
 * @property $address
 * @property $image
 * @property $status
 * @property $room_stay_id
 * @property $reservation_id
 * @property $created_at
 * @property $updated_at
 * @method static whereEmail($email)
 */
class Guest extends Model
{
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

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
     * Relationship with the Image model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * full_name accessor which calculates the room count attribute.
     *
     * @return int
     */
    public function getFullNameAttribute()
    {
        if ($this->last_name) {
            return sprintf("%s %s", $this->last_name, $this->first_name);
        }

        return '';
    }

    /**
     * Set guest status to arrived.
     */
    public function checkin()
    {
        $this->status = 'Arrived';
        $this->save();
    }

    /**
     * Save an image to the disk storage for a specific model.
     *
     * @param array $attributes
     * @param array $options
     * @return Guest
     */
    public function update(array $attributes = [], array $options = []) {
        $this->first_name = $attributes['first_name'];
        $this->last_name = $attributes['last_name'];
        $this->email = $attributes['email'];
        $this->nationality = $attributes['nationality'];
        $this->phone = $attributes['phone'];
        $this->address = $attributes['address'];
        $this->updated_at = now();
        $this->save();

        return $this;
    }

    /**
     * Save an image to the disk storage for a specific model.
     *
     * @param UploadedFile $uploadedFile
     */
    public function saveImage(UploadedFile $uploadedFile) {
        $path = $uploadedFile->store('uploads', 'public');

        $guestImage = new Image();
        $guestImage->url = config('app.url') . "/$path";
        $guestImage->path = "/$path";

        $this->image()->save($guestImage);
    }


    /**
     * Local query for guest via email.
     *
     * @param Builder $query
     * @param $email
     * @return Builder
     */
    public static function scopeWhereEmail(Builder $query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Create a new guest.
     *
     * @param array $attributes
     * @return Guest
     */
    public static function create(array $attributes)
    {
        $guest = new self();
        $guest->unique_id = uniqid('', false);
        $guest->first_name = $attributes['first_name'];
        $guest->last_name = $attributes['last_name'];
        $guest->email = $attributes['email'];
        $guest->nationality = $attributes['nationality'];
        $guest->phone = $attributes['phone'];
        $guest->address = $attributes['address'];
        $guest->room_stay_id = $attributes['room_stay_id'];
        $guest->reservation_id = $attributes['reservation_id'];
        $guest->save();

        return $guest;
    }
}
