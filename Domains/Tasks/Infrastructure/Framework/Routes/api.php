<?php

$router->group([], function () use ($router) {
    $router->get('/', function () {
        echo 444;
    });
    $router->get('/test', function () {
        echo 3222;
    });
});
