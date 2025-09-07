<?php

namespace Samuelpouzet\Restfull\Listener\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Samuelpouzet\Restfull\Listener\RouteListener;

class RouteListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): RouteListener
    {
        return new RouteListener();
    }
}
