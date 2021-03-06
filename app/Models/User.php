<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

/**
 * Class User represents all the users of the system.
 *
 * @package App\Models
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $username
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $remember_token
 * @property $role_id
 * @property $image
 * @property $created_at
 * @property $updated_at
 * @method static whereEmail($email)
 * @method static whereVerified()
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
     * full_name accessor which calculates the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    /**
     * Save an image to the disk storage for a specific model.
     *
     * @param UploadedFile $uploadedFile
     */
    public function saveImage(UploadedFile $uploadedFile)
    {

        if ($this->image) {
            Storage::disk('public')->delete($this->image->path);
            $this->image()->delete();
        }

        $path = $uploadedFile->store('uploads', 'public');

        $roomImage = new Image();
        $roomImage->url = config('app.url') . "/$path";
        $roomImage->path = "/$path";

        $this->image()->save($roomImage);
    }

    /**
     * Filter by email.
     *
     * @param Builder $query
     * @param string $email
     * @return Builder
     */
    public static function scopeWhereEmail(Builder $query, string $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Filter by verified users.
     *
     * @param Builder $query
     * @return Builder
     */
    public static function scopeWhereVerified(Builder $query)
    {
        return $query->whereRaw('email_verified_at <> ""');
    }

    /**
     * Update user.
     *
     * @param array $attributes
     * @param array $options
     * @return $this|bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        $userPermissions = $this->getAllPermissions();

        foreach ($userPermissions as $permission) {
            $this->revokePermissionTo($permission->name);
        }

        foreach ($attributes['permissions'] as $permission) {
            $this->givePermissionTo($permission);
        }

        return $this;
    }
}
