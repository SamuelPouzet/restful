<?php

namespace Samuelpouzet\Restfull\Listener\Factory;

use Laminas\Mvc\Controller\ControllerManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Samuelpouzet\Restfull\Listener\DispatchListener;

class DispatchListenerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): DispatchListener
    {
        $controllerManager = $container->get(ControllerManager::class);
        return new DispatchListener($controllerManager);
    }
}
