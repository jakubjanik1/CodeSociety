<?php

require 'vendor/autoload.php';

use Core\{Router, Request};

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());