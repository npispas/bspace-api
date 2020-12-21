<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomType represents the available room types in the system.
 *
 * @package App\Models
 * @property $id
 * @property $code
 * @property $name
 * @property $max_occupancy
 * @property $min_occupancy
 * @property $created_at
 * @property $updated_at
 */
class RoomType extends Model
{
    use HasFactory;
}
