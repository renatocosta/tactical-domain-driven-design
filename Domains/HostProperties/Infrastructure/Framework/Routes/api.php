<?php

$router->group([], function () use ($router) {
    $router->group(['prefix' => 'property'], function ($router) {
        $router->get('/', 'PropertyController@fetchAll');
        $router->post('/', 'PropertyController@create');
    });
    $router->group(['prefix' => 'calendar'], function ($router) {
        $router->get('/', 'CalendarController@fetchAll');
        $router->post('/', 'CalendarController@create');
    });
});
