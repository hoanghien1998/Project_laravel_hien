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
     * Format object to array
     * @return array
     */
    public function transform()
    {
        $data = [
            'id' => $this->id,
            'seat' => $this->seat,
            'model' => $this->model,
            'body' => $this->body,
            'year' => $this->year,
            'price' => $this->price,
            'dueDate' => $this->dueDate,
            'startBid' => $this->startBid,
            'endBid' => $this->endBid,
            'description' => $this->description,
        ];
        $data['photo'] = $this->photo();
        return $data;
    }

    /**
     * Format data photo
     * @return array
     */
    public function photo()
    {
        $photo = Photo::where([
            'carId' => $this->id,
        ])->first();
        if (!empty($photo)) {
            return $photo->photo;
        } else {
            return null;
        }
    }

    /**
     * Return all images according to carId
     * @return HasMany
     */
    public function image()
    {
        return $this->hasMany('App\Photo', 'carId');
    }
}
