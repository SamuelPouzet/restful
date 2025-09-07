<?php

namespace Samuelpouzet\Restfull\Listener;

use Laminas\Mvc\Application;
use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\RouteListener as parentListener;
use Laminas\Router\RouteMatch;

class RouteListener extends parentListener
{
    /**
     * Listen to the "route" event and attempt to route the request
     *
     * If no matches are returned, triggers "dispatch.error" in order to
     * create a 404 response.
     *
     * Seeds the event with the route match on completion.
     *
     * @param  MvcEvent $event
     * @return null|RouteMatch
     */
    public function onRoute(MvcEvent $event)
    {
        $request    = $event->getRequest();
        $router     = $event->getRouter();
        $routeMatch = $router->match($request);

        if ($routeMatch instanceof RouteMatch) {
            //on récupère la méthode;
            $this->getAction($routeMatch, $event);
            $event->setRouteMatch($routeMatch);
            return $routeMatch;
        }

        $event->setName(MvcEvent::EVENT_DISPATCH_ERROR);
        $event->setError(Application::ERROR_ROUTER_NO_MATCH);

        $target  = $event->getTarget();
        $results = $target->getEventManager()->triggerEvent($event);
        if (! empty($results)) {
            return $results->last();
        }

        return $event->getParams();
    }

    protected function getAction(RouteMatch $routeMatch, MvcEvent $event): void
    {
        $method = $this->getMethod();
        if ($method === 'get') {
            $identifierName = $event->getParam('identifierName') ?? 'id';
            if ( null === $routeMatch->getParam($identifierName)) {
                $method = 'getall';
            }
        }
       $routeMatch->setParam('action', $method);
    }

    protected function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
