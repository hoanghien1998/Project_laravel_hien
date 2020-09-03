<?php

namespace App\Http\Controllers;

use App\Car;
use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use function GuzzleHttp\json_encode;

class CarController extends Controller
{
    public function createCar(Request $request)
    {
        //input
        $seat = $request->get('seat');
        $startingPrice = $request->get('startingPrice');
        $dueDate = $request->get('dueDate');
        $carYear = $request->get('carYear');
        $carModel = $request->get('carModel');
        $carBody = $request->get('carBody');
        $startBidTime = $request->get('startBidTime');
        $bidDuration = $request->get('bidDuration');
        $description = $request->get('description');
        $photo = $request->get('photo');

        $car = Car::create([
            'seat'=>$seat,
            'startingPrice'=>$startingPrice,
            'dueDate'=>$dueDate,
            'carYear'=>$carYear,
            'carModel'=>$carModel,
            'carBody'=>$carBody,
            'startBidTime'=>$startBidTime,
            'bidDuration'=>$bidDuration,
            'description'=>$description,
        ]);
        $photo = Photo::create([
            'carId'=>$car->id,
            'photo'=>$photo,
        ]);
        return json_encode($car->transform());


    }

    public function updateCar(Request $request)
    {
        $photo=$request->get('photo');
        $car  = Car::find($request->get('id'));
        $car->seat = $request->input('seat');
        $car->startingPrice = $request->input('startingPrice');
        $car->dueDate = $request->input('dueDate');
        $car->carYear = $request->input('carYear');
        $car->carModel = $request->input('carModel');
        $car->carBody = $request->input('carBody');
        $car->startBidTime = $request->input('startBidTime');
        $car->bidDuration = $request->input('bidDuration');
        $car->description = $request->input('description');
        $car->save();

            $photo = Photo::where([
                'photo'=>$photo,
            ])->first();
            if (!empty($photo)){
                $photo->update(['carId'=>$car->id]);
            }


        return json_encode($car->transform());
    }
    public function deleteCar($id)
    {
        $car  = Car::find($id);
        $car->delete();

        return response()->json('Removed successfully.');
    }
    public function index()
    {
$items=[];
        $cars  = Car::all();
foreach ($cars as $car){
    $items=$car->transform();
}
$data=[
    'items'=>$items
];
        return response()->json($data);
    }
}
