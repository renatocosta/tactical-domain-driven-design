<?php

$router->group([], function () use ($router) {
    $router->get('/', 'PropertyController@fetchAll');
    $router->post('/', 'PropertyController@create');
});
