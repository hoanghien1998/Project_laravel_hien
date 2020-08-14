<?php

use App;

class BookController
{
    public function bookList()
    {
        $books = App::get('Connect');
        return view('booklist', compact('books'));
    }

    public function addBook()
    {
        return view('addbook');
    }
    public function storeBook()
    {
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
            var_dump($finalBooks);
            die();

            file_put_contents('core/database/books.json', $finalBooks);
        } else {
            $error = "JSON File not exits";
        }


        return redirect('');
    }
}
