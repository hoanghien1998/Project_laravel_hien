<?php

use App;
use Request;
use Connect;

class BookController
{
    protected $request;
    public function bookList()
    {
        $books = App::get('Connect');
        return view('booklist', compact('books'));
    }

    public function addBook()
    {
        if (Request::method() == 'GET') {
            $create = 1;
            return view('addbook', compact('create'));
        } else {
            if (file_exists('core/database/books.json')) {
                $array_data = App::get('Connect');
                /** @var TYPE_NAME $extra */
                $extra = array(
                    'isbn'           =>     $_POST['isbn'],
                    'title'          =>     $_POST["title"],
                    'subtitle'       =>     $_POST["subtitle"],
                    'author'         =>     $_POST['author'],
                    'published'      =>     $_POST["published"],
                    'publisher'      =>     $_POST["publisher"],
                    'pages'          =>     $_POST['pages'],
                    'description'    =>     $_POST["description"],
                    'website'        =>     $_POST["website"]
                );
                $array_data[] = $extra;

                $listBook = array(
                    "books" => $array_data
                );

                $finalBooks = json_encode($listBook);

                file_put_contents('core/database/books.json', $finalBooks);
            } else {
                $error = "JSON File not exits";
            }


            return redirect('');
        }
    }

    public function updateBook()
    {
        //input
        if (Request::method() == 'GET') {
            $isbn = Request::get('isbn');
            //check exists
            $books = App::get('Connect');
            foreach ($books as $book) {
                if ($isbn == $book['isbn']) {
                    $found_book = $book;
                }
            }
            if (empty($found_book)) {
                return 'Data not found';
            }
            return view('addbook', compact('found_book'));
        } elseif (Request::method() == 'POST') {
            //input
            $isbn = Request::post('isbn');
            $extra = array(
                'isbn'           =>     $_POST['isbn'],
                'title'          =>     $_POST["title"],
                'subtitle'       =>     $_POST["subtitle"],
                'author'         =>     $_POST['author'],
                'published'      =>     $_POST["published"],
                'publisher'      =>     $_POST["publisher"],
                'pages'          =>     $_POST['pages'],
                'description'    =>     $_POST["description"],
                'website'        =>     $_POST["website"]
            );

            $array_data = App::get('Connect');
            foreach ($array_data as $key => $array_datum) {
                if ($isbn == $array_datum['isbn']) {
                    //update new book
                    $array_data[$key] = $extra;
                }
            }

            $listBook = array(
                "books" => $array_data
            );

            $finalBooks = json_encode($listBook);

            file_put_contents('core/database/books.json', $finalBooks);
            return redirect('');
        }
    }
}
