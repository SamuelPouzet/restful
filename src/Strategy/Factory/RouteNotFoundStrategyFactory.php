<?php

namespace Samuelpouzet\Restfull\Strategy\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Samuelpouzet\Restfull\Strategy\RouteNotFoundStrategy;

class RouteNotFoundStrategyFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ): RouteNotFoundStrategy {
        return new RouteNotFoundStrategy();
    }
}
