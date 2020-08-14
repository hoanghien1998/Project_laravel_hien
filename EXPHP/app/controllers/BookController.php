<?php

use App;

class BookController
{
    public function bookList()
    {
        $books = App::get('Connect');
        return view('booklist', compact('books'));

    }
}
