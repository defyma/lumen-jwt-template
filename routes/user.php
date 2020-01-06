<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('user', 'UserController@profile');
$router->get('user/{id}', 'UserController@singleUser');

$router->get('users', 'UserController@allUsers');

