<?php

use Core\Router;

$router = new Router();

//Register routes
$router->get('/', 'HomeController@index');
$router->get('/about', 'HomeController@about', 'AuthMiddleware');
