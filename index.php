<?php

require 'vendor/autoload.php';

if (file_exists('.env'))
{
    Dotenv\Dotenv::create(__DIR__)->load();
}

require 'core/bootstrap.php';

use Core\{Router, Request, Session};

Session::start();

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());