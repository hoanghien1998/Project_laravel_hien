<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';
require 'core/database/Connect.php';

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
