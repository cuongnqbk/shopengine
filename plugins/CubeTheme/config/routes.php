<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'CubeTheme',
    ['path' => '/cube-theme'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
