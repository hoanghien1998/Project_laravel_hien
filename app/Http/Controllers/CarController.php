<?php

namespace App\Http\Controllers;

use App\Car;
use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use function GuzzleHttp\json_encode;

class CarController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * Add new car
     */
    public function createCar(Request $request)
    {
        //input
        $seat = $request->get('seat');
        $model = $request->get('model');
        $body = $request->get('body');
        $year = $request->get('year');
        $price = $request->get('price');
        $dueDate = $request->get('dueDate');
        $startBid = $request->get('startBid');
        $endBid = $request->get('endBid');
        $description = $request->get('description');
        $car = Car::create([
            'seat' => $seat,
            'model' => $model,
            'body' => $body,
            'year' => $year,
            'price' => $price,
            'dueDate' => $dueDate,
            'startBid' => $startBid,
            'endBid' => $endBid,
            'description' => $description,
        ]);

        $name = $request->image->getClientOriginalName();
        $request->image->move(public_path('image'), $name);

        $photo = Photo::create([
            'carId' => $car->id,
            'photo' => $name,
        ]);

        return response()->json($car->transform());
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * Update data for car
     */
    public function updateCar(Request $request, $id)
    {

        $car = Car::find($id);
        $car->update($request->all());
        $car->save();
        return response()->json($car);

//        $photo = $request->get('photo');
//        $photo = Photo::where([
//            'photo' => $photo,
//        ])->first();
//        if (!empty($photo)) {
//            $photo->update(['carId' => $car->id]);
//        }
//        return json_encode($car->transform());
    }

    public function deleteCar($id)
    {
        $car = Car::find($id);
        $car->delete();

        return response()->json('Removed successfully.');
    }

    /**
     * @return JsonResponse
     * Show all list information car
     */
    public function index()
    {

        return response()->json(Car::get(), 200);
    }

    /**
     * @param $carId
     * @return JsonResponse
     * Show images of car according to carId
     */
    public function ListImages($carId)
    {
        $photo = Photo::find($carId);
        return response()->json($photo, 200);
    }
}
