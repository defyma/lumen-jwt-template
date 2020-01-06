<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'auth'], function () use ($router) {

    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');

});
