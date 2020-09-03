<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
      'carId','photo'
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
    public  function transform(){
        $data=[
            'id'=>$this->id,
            'carId'=>$this->carId,
            'photo'=>$this->photo,
        ];
        return $data;
    }
}
