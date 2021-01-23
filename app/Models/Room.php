<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
}
