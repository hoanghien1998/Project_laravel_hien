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

        $images = $request->names;

        foreach ($images as $img => $image) {
            Photo::create([
                'carId' => $car->id,
                'photo' => $image,
            ]);
        }
        return response()->json($this->transform($car));
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
        if ($request->isMethod('post')) {
            //validation
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
            //check exists
            $car = Car::find($id);

            if (empty($car)) {
                return $this->errorBadRequest(trans('core.not_found_record'));
            }
            $car->update([
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
            //update image
            $name_image = $request->photo->getClientOriginalName();
            $request->photo->move(public_path('image'), $name_image);
            $photo = Photo::where('carId', $car->id);
            $photo->update(['photo' => $name_image]);
            return response()->json($this->transform($car));
        }
    }

    /***
     * Get information car to show form
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $car = Car::find($id);
        return response()->json($this->transform($car));
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
     * @param $carId
     * @return JsonResponse
     */
    public function ShowImages($carId)
    {
        $photo = Photo::where('carId', $carId)->pluck('photo');
        return response()->json(['photo' => $photo], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request)
    {
        $name = $request->image->getClientOriginalName();
        $request->image->move(public_path('image'), $name);

        return response()->json(['file' => $name], 200);
    }

    /**
     * Format data photo
     * @return array
     */
    public function photo($id)
    {
        $photo = Photo::where([
            'carId' => $id,
        ])->first();
        if (!empty($photo)) {
            return $photo->photo;
        } else {
            return null;
        }
    }

    /**
     * Format object to array
     * @return array
     */
    public function transform($car)
    {

        $data = [
            'seat' => $car->seat,
            'model' => $car->model,
            'body' => $car->body,
            'year' => $car->year,
            'price' => $car->price,
            'dueDate' => $car->dueDate,
            'startBid' => $car->startBid,
            'endBid' => $car->endBid,
            'description' => $car->description,
        ];
        $data['photo'] = $this->photo($car->id);
        return $data;
    }
}
