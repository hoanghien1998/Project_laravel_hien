<?php
/**
 * use BookController to handle data that the user inputs or submits
 */
use App;
use Request;

class BookController
{
    protected $request;

    /**
     * Function bookList use to show all list book from file json
     * Return to view show booklist
     */
    public function bookList()
    {
        $books = App::get('Connect');
        return view('booklist', compact('books'));
    }
    /**
     * Function addBook use to add book in file data json
     * Variable $create use to check is request add to show form add
     * Method get is get data from file json
     * Method POST is save data in file json
     * Return to view show addbook
     */
    public function addBook()
    {
        if (Request::method() == 'GET') {
            $create = 1;
            return view('addbook', compact('create'));
        } else {
            $error = [];
            if (file_exists('core/database/books.json')) {
                $array_data = App::get('Connect');
                // Check isbn is numeric
                if (!is_numeric($_POST['isbn'])) {
                    $error['isbn'] = "Isbn is numeric";
                    return view('addbook', compact('error'));
                }
                // Validate isbn
                foreach ($array_data as $array_datum) {
                    if ($array_datum['isbn'] == $_POST['isbn']) {
                        $error['isbn'] = "Isbn is unique, enter the orther one";
                        return view('addbook', compact('error'));
                    }
                }
                /** @var TYPE_NAME $extra */
                $extra = [
                    'isbn' => $_POST['isbn'],
                    'title' => $_POST["title"],
                    'subtitle' => $_POST["subtitle"],
                    'author' => $_POST['author'],
                    'published' => $_POST["published"],
                    'publisher' => $_POST["publisher"],
                    'pages' => $_POST['pages'],
                    'description' => $_POST["description"],
                    'website' => $_POST["website"],
                ];
                $array_data[] = $extra;

                $listBook = [
                    "books" => $array_data,
                ];

                $finalBooks = json_encode($listBook);

                file_put_contents('core/database/books.json', $finalBooks);
            } else {
                $error = "JSON File not exits";
            }


            return redirect('');
        }
    }
    /**
     * Function updateBook use to edit book in file data json
     * Method get is get data from file json
     * Method POST is save data changed in file json
     * Return to view show addbook form update
     */
    public function updateBook()
    {
        // Input
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
            // Input
            $isbn = Request::post('isbn');
            $extra = [
                'isbn' => $_POST['isbn'],
                'title' => $_POST["title"],
                'subtitle' => $_POST["subtitle"],
                'author' => $_POST['author'],
                'published' => $_POST["published"],
                'publisher' => $_POST["publisher"],
                'pages' => $_POST['pages'],
                'description' => $_POST["description"],
                'website' => $_POST["website"],
            ];

            $array_data = App::get('Connect');
            foreach ($array_data as $key => $array_datum) {
                if ($isbn == $array_datum['isbn']) {
                    // Update new book
                    $array_data[$key] = $extra;
                }
            }

            $listBook = [
                "books" => $array_data,
            ];

            $finalBooks = json_encode($listBook);

            file_put_contents('core/database/books.json', $finalBooks);
            return redirect('');
        }
    }

    /**
     * Function reloadBook use to refesh data when update new
     */
    public function reloadBook()
    {
        header('Content-Type: application/json');
        // Get data
        try {
            $array_data = App::get('Connect');
        } catch (Exception $e) {
            throwException($e);
        }
        echo json_encode($array_data);
        die();
    }
}
