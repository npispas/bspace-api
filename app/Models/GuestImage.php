<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuestImage represents the guest's images.
 *
 * @package App\Models
 * @property $id
 * @property $url
 * @property $created_at
 * @property $updated_at
 */
class GuestImage extends Model
{
    use HasFactory;

    /**
     * Relationship with the Guest model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
