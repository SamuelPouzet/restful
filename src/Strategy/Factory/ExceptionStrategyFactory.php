<?php

namespace Samuelpouzet\Restfull\Strategy\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Samuelpouzet\Restfull\Strategy\ExceptionStrategy;

class ExceptionStrategyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ExceptionStrategy
    {
        return new ExceptionStrategy();
    }
}
