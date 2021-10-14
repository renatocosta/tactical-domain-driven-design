<?php

$router->group([], function () use ($router) {
    $router->post('/', 'PropertyController@create');
});
