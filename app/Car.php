<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'seat', 'model',
        'body', 'year', 'price',
        'dueDate', 'startBid',
        'endBid', 'description'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @var string[]
     */
    protected $appends = ['default_image'];


    /**
     * Return all images according to carId
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany(Photo::class, 'carId');
    }

    public function getDefaultImageAttribute()
    {
        return $this->images()->orderBy('id')->first();
    }
}
