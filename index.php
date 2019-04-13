<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use Core\{Router, Request, Session};

Session::start();

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());