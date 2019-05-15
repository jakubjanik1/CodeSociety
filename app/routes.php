<?php

$router->get('', 'ArticlesController@articlesByPage');
$router->get('articles', 'ArticlesController@articlesByPage');
$router->get('articles/page/{page}', 'ArticlesController@articlesByPage');

$router->get('articles/category/{category}', 'ArticlesController@articlesByCategory');
$router->get('articles/category/{category}/page/{page}', 'ArticlesController@articlesByCategory');

$router->get('articles/search/{searchTerm}', 'ArticlesController@search');
$router->get('articles/search/{searchTerm}/page/{page}', 'ArticlesController@search');

$router->get('article/{slug}', 'ArticlesController@article');
$router->get('article/{id}/like', 'ArticlesController@likeArticle');

$router->get('admin', 'AdminController@home');
$router->get('admin/articles', 'AdminController@articles');
$router->get('admin/article/delete/{id}', 'AdminController@deleteArticle');
$router->get('admin/article/edit/{slug}', 'AdminController@editArticle');
$router->get('admin/article/add', 'AdminController@addArticle');
$router->post('admin/article/store', 'AdminController@storeArticle');

$router->get('admin/authenticate', 'AdminController@authenticate');
$router->post('admin/authenticate', 'AdminController@authenticate');

$router->post('newsletter/subscribe', 'NewsletterController@subscribe');

$router->get('account/register', 'AccountsController@register');
$router->post('account/register', 'AccountsController@register');
$router->post('account/login/exists', 'AccountsController@loginExists');

$router->get('account/login', 'AccountsController@login');
$router->post('account/login', 'AccountsController@login');

$router->get('account/logout', 'AccountsController@logout');
$router->get('account/{login}/view', 'AccountsController@view');

$router->get('comments/article/{id}', 'CommentsController@comments');
$router->post('comments/add', 'CommentsController@storeComment');

$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
$router->post('contact', 'PagesController@contact');