<?php
namespace Samuelpouzet\Restfull;

use Samuelpouzet\Restfull\Listener\Factory\RouteListenerFactory;
use Samuelpouzet\Restfull\Listener\RouteListener;
use Samuelpouzet\Restfull\Strategy\Factory\ExceptionStrategyFactory;
use Samuelpouzet\Restfull\Strategy\Factory\RouteNotFoundStrategyFactory;

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
