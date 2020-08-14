<?php

try {
    // Read JSON file
    $data = file_get_contents('core/database/books.json');

    //Decode JSON
    $books = json_decode($data, true);

    App::bind('Connect', $books['books']);
} catch (Exception $e) {
    throwException($e);
}
