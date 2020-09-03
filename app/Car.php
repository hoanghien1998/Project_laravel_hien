<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * @var string[]
     */
    protected $fillable =[
        'seat', 'startingPrice',
        'dueDate', 'carYear', 'carModel',
        'carBody', 'startBidTime',
        'bidDuration', 'description'
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
            'seat'=>$this->seat,
            'startingPrice'=>$this->startingPrice,
            'dueDate'=>$this->dueDate,
            'carYear'=>$this->carYear,
            'carModel'=>$this->carModel,
            'carBody'=>$this->carBody,
            'startBidTime'=>$this->startBidTime,
            'bidDuration'=>$this->bidDuration,
            'description'=>$this->description,
        ];
        $data['photos']=$this->photos();
        return $data;
    }
    public function photos(){
        $photos=Photo::where([
            'carId'=>$this->id,
        ])->get();
        $data=[];
        if (!empty($photos)){
            foreach ($photos as $photo){
                $data[]=$photo->transform();
            }
        }
        return $data;
    }
}
