<?php

namespace App\Http\Controllers;

use App\Car;
use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CarController extends Controller
{
    public function createCar(Request $request)
    {
        $car = Car::create($request->all());
        $photo = Photo::create($request->all());
//        $photo->dump($car->id)-> get(['listing']);
//        dump($photo);
        $photo->save();
        return response()->json($car, $photo);
    }

    public function updateCar(Request $request, $id)
    {
        $car  = Car::find($id);
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

        return response()->json($car);
    }
    public function deleteCar($id)
    {
        $car  = Car::find($id);
        $car->delete();

        return response()->json('Removed successfully.');
    }
    public function index()
    {

        $cars  = Car::all();
        $photos = Photo::all();

        return response()->json($cars, $photos);
    }
}
