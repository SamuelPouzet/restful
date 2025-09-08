<?php
namespace Samuelpouzet\Restful;

use Samuelpouzet\Restful\Listener\Factory\RouteListenerFactory;
use Samuelpouzet\Restful\Listener\RouteListener;
use Samuelpouzet\Restful\Strategy\Factory\ExceptionStrategyFactory;
use Samuelpouzet\Restful\Strategy\Factory\RouteNotFoundStrategyFactory;

return [
    'service_manager' => [
        'factories' => [
            // override strategies
            'HttpExceptionStrategy'     => ExceptionStrategyFactory::class,
            'HttpRouteNotFoundStrategy' => RouteNotFoundStrategyFactory::class,
            //needs a PR to clean on parent
            RouteListener::class        => RouteListenerFactory::class,
        ],
        'aliases'  => [
            'RouteListener'             => RouteListener::class,
        ]
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
