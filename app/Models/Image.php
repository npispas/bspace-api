<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image represents all the uploaded images in the system.
 * Related models are Users, Rooms and Guest.
 *
 * @package App\Models
 * @property $id
 * @property $url
 * @property $path
 * @property $created_at
 * @property $updated_at
 */
class Image extends Model
{
    use HasFactory;

    /**
     * Get the parent imageable model (user or post).
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
