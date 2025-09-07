<?php

namespace Samuelpouzet\Restfull\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\Mvc\DispatchListener as parentListener;
use Laminas\Mvc\MvcEvent;

class DispatchListener extends parentListener
{
    protected readonly string $identifierName;

    public function attach(EventManagerInterface $events, $priority = 1): void
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
        if (function_exists('zend_monitor_custom_event_ex')) {
            $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'reportMonitorEvent']);
        }
    }

    public function onDispatch(MvcEvent $e): void
    {
        parent::onDispatch($e);
        // var_dump($e);
    }
}
