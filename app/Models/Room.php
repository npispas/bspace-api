<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Room represents all the rooms available in the system.
 *
 * @package App\Models
 * @property $id
 * @property $unique_id
 * @property $name
 * @property $description
 * @property $interior_size
 * @property $max_occupancy
 * @property $min_occupancy
 * @property $available_from
 * @property $available_to
 * @property $is_published
 * @property $images
 * @property $location
 * @property $created_at
 * @property $updated_at
 * @method static whereOccupancy($guestCount)
 * @method static whereAvailable($startDate, $endDate)
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
     * Relationship with the Image model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Relationship with the RoomStay model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roomStays()
    {
        return $this->belongsToMany(RoomStay::class)->withTimestamps();
    }

    /**
     * Save an image to the disk storage for a specific model.
     *
     * @param UploadedFile $uploadedFile
     */
    public function saveImage(UploadedFile $uploadedFile) {
        $path = $uploadedFile->store('uploads', 'public');

        $roomImage = new Image();
        $roomImage->path = "/$path";
        $roomImage->url = config('app.url') . "/$path";

        $this->images()->save($roomImage);
    }

    /**
     * Delete image stored image.
     *
     * @param Image $image
     * @throws Exception
     */
    public function deleteImage(Image $image) {
        Storage::disk('public')->delete($image->path);

        $image->delete();
    }

    /**
     * Local query for rooms which can hold this number of guests.
     *
     * @param Builder $query
     * @param int $guestCount
     * @return Builder
     */
    public static function scopeWhereOccupancy(Builder $query, int $guestCount)
    {
        return $query->where('min_occupancy', '<=', $guestCount)
            ->where('max_occupancy', '>=', $guestCount);
    }

    /**
     * Local query for rooms which are not reserved during or after the provided start date and during or prior the
     * provided end date.
     *
     * @param Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return Builder
     */
    public static function scopeWhereAvailable(Builder $query, string $startDate, string $endDate)
    {
        return $query->whereHas('roomStays', function ($q) use ($startDate, $endDate) {
            return $q->where('start_date', '>=', $endDate)->orWhere('end_date', '<=', $startDate);
        });
    }

    public static function create(array $attributes)
    {
        $room = new self();
        $room->name = $attributes['name'];
        $room->unique_id = Str::uuid();
        $room->location = $attributes['location'];
        $room->interior_size = $attributes['interior_size'];
        $room->min_occupancy = $attributes['min_occupancy'];
        $room->max_occupancy = $attributes['max_occupancy'];
        $room->available_from = $attributes['available_from'];
        $room->available_to = $attributes['available_to'];
        $room->is_published = $attributes['is_published'];
        $room->description = $attributes['description'];

        $roomType = RoomType::findOrFail($attributes['room_type_id']);
        $roomType->rooms()->save($room);

        $files = $attributes['images'];

        if (!empty($files)) {
            foreach ($files as $file) {
                $room->saveImage($file);
            }
        }

        return $room;
    }
}
