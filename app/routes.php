<?php

$router->get('index', 'PagesController@index');

$router->get('articles', 'PagesController@articlesByPage');
$router->get('articles/page/{page}', 'PagesController@articlesByPage');

$router->get('articles/category/{category}', 'PagesController@articlesByCategory');
$router->get('articles/category/{category}/page/{page}', 'PagesController@articlesByCategory');

$router->get('articles/author/{author}/page/{page}', 'PagesController@articlesByAuthor');
$router->get('articles/author/{author}', 'PagesController@articlesByAuthor');

$router->get('articles/category/{category}/author/{author}/page/{page}', 'PagesController@articles');
$router->get('articles/category/{category}/author/{author}', 'PagesController@articles');