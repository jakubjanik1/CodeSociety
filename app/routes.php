<?php

//$router->get('index', 'ArticlesController@index');

$router->get('articles', 'ArticlesController@articlesByPage');
$router->get('articles/page/{page}', 'ArticlesController@articlesByPage');

$router->get('articles/category/{category}', 'ArticlesController@articlesByCategory');
$router->get('articles/category/{category}/page/{page}', 'ArticlesController@articlesByCategory');

$router->get('articles/author/{author}/page/{page}', 'ArticlesController@articlesByAuthor');
$router->get('articles/author/{author}', 'ArticlesController@articlesByAuthor');