<?php

namespace Samuelpouzet\Restful\Strategy;

use Laminas\Http\Request;
use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\View\Http\RouteNotFoundStrategy as parentStrategy;
use Laminas\Stdlib\ResponseInterface as Response;
use Laminas\View\Model\JsonModel;

class RouteNotFoundStrategy extends parentStrategy
{
    public function errorHandler(MvcEvent $event): void
    {
        die('error 404');
    }

    public function prepareNotFoundViewModel(MvcEvent $event): void
    {
        $vars = $event->getResult();
        if ($vars instanceof Response) {
            // Already have a response as the result
            return;
        }

        $response = $event->getResponse();
        if ($response->getStatusCode() != 404) {
            // Only handle 404 responses
            return;
        }

        $model = new JsonModel([
            'status' => \Laminas\Http\Response::STATUS_CODE_404,
        ]);

        $request = new Request();
        $request->setContent($model);
        $event->getResponse()->setStatusCode(\Laminas\Http\Response::STATUS_CODE_404);
        $event->setViewModel($model);
        $event->stopPropagation();
        $event->setError('123456');
    }
}
