<?php

/** @var TYPE_NAME $router */
$router->get('', 'BookController@bookList');
$router->get('add', 'BookController@addBook');
