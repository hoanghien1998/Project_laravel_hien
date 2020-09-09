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
     * Add new car.
     * Get input from user to create information for table cars and table photos according to id.
     * Return response for user
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
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

        Photo::create([
            'carId' => $car->id,
            'photo' => $name,
        ]);

        return response()->json($car->transform());
    }

    /**
     * Check validation before save new input into data.
     * Update data for car
     * @param Request $request
     * @param $id
     * @return JsonResponse
     *
     */
    public function update(Request $request, $id)
    {
        $car = Car::find($id);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'seat' => 'required|integer|min:4',
                'model' => 'required|string',
                'body' => 'required|string',
                'year' => 'required|numeric',
                'price' => 'required|numeric',
                'dueDate' => 'required|date',
                'startBid' => 'required|string',
                'endBid' => 'required|string',
                'description' => 'required|string',]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            Car::where('id', $id)->update(array_merge(
                $validator->validated()
            ));
            $photo = Photo::where('carId', $car->_id)->first();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('image'), $name);
                $photo->file= $name;
            }

            $photo->save();
            return response()->json($car->transform());
        }
        return response()->json($car->transform());
    }

    /**
     * Delete car according to id, first delete image, after delete car
     * @param $id
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        $car = Car::find($id);
        Photo::where('carId', $car->id)->delete();
        $car->delete();

        return response()->json('Removed successfully.');
    }

    /**
     * Show all list information car
     * @return JsonResponse
     */
    public function index()
    {

        return response()->json(Car::get(), 200);
    }

    /**
     * Show images of car according to carId
     * @param $carId
     *
     * @return JsonResponse
     */
    public function ShowImages($carId)
    {
        $photo = Photo::find($carId);
        return response()->json($photo, 200);
    }
}
