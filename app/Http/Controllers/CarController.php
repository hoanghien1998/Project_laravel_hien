<?php

namespace App\Http\Controllers;

use App\Car;
use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use function GuzzleHttp\json_encode;
use Validator;

/**
 * Class CarController
 * Class CarController use to add new car, update car, show list car
 * @package App\Http\Controllers
 */
class CarController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * Add new car
     * Get input from user to create information for table cars and table photos according to id
     * Return response for user
     */
    public function createCar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seat' => 'required|integer|min:4',
            'model' => 'required|string',
            'body' => 'required|string',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'dueDate' => 'required|date',
            'startBid' => 'required|string',
            'endBid' => 'required|string',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $car = Car::create(array_merge(
            $validator->validated()
        ));

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
     * UpdateCar use 2 method get and post. If method GET to get data into the input, If method POST to update data all field in table cars,
     * table photos to delete old image then add new image.
     * @param $id
     * @return JsonResponse
     * Update data for car
     */
    public function updateCar(Request $request, $id)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $car = Car::find($id);
            return response()->json($car->transform());
        } else {
            $car = Car::find($id);

            #region delete old Image
            $photo = Photo::where('carId', $car->_id);
            $photo->delete();
            #endregion
            $car->update($request->all());

            #region add new Image
            //Todo
            $name = $request->photo->getClientOriginalName();
            $request->photo->move(public_path('image'), $name);
            $photo = Photo::create([
                'carId' => $car->id,
                'photo' => $name,
            ]);
            #endregion
            return response()->json($car->transform());
        }
    }

    /**
     * @param $id
     * Delete car according to id
     * @return JsonResponse
     */
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
