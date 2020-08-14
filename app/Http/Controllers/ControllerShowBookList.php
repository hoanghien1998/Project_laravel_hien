<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ControllerShowBookList extends Controller
{
    public function LoadJson()
    {
        // Get data from file books.json stored in storage
        $jsonString = Storage::disk('local')->get('books.json');

        // Parse json to array
        $data = json_decode($jsonString, true);
        $list = collect($data);
        return view('list.ListBooks', compact('list'));
    }
}
