<?php

/** @var TYPE_NAME $router */
$router->get('', 'BookController@bookList');
$router->get('add', 'BookController@addBook');
$router->post('add', 'BookController@addBook');
$router->get('update', 'BookController@updateBook');
$router->post('update', 'BookController@updateBook');
