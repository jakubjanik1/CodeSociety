<?php

require 'core/Router.php';
require 'core/Request.php';

use Core\{Router, Request};

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());