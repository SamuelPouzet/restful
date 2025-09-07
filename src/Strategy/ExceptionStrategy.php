<?php

namespace Samuelpouzet\Restfull\Strategy;

use Laminas\Http\Response as HttpResponse;
use Laminas\Mvc\Application;
use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\View\Http\ExceptionStrategy as parentStrategy;
use Laminas\Stdlib\ResponseInterface as Response;
use Laminas\View\Model\JsonModel;

class ExceptionStrategy extends parentStrategy
{
    public function prepareExceptionViewModel(MvcEvent $e)
    {
        // Do nothing if no error in the event
        $error = $e->getError();
        if (empty($error)) {
            return;
        }

        // Do nothing if the result is a response object
        $result = $e->getResult();
        if ($result instanceof Response) {
            return;
        }

        switch ($error) {
            case Application::ERROR_CONTROLLER_NOT_FOUND:
            case Application::ERROR_CONTROLLER_INVALID:
            case Application::ERROR_ROUTER_NO_MATCH:
                // Specifically not handling these
                return;

            case Application::ERROR_EXCEPTION:
            default:
                if (true or $this->displayExceptions()) {
                    $exception = $e->getParam('exception');
                    $model = new JsonModel([
                        'message' => $exception->getMessage(),
                        'trace' => $exception->getTraceAsString(),
                        'display_exceptions' => $this->displayExceptions(),
                    ]);
                } else {
                    $model = new JsonModel([
                        'message' => 'An error occurred during execution; please try again later.',
                        'display_exceptions' => $this->displayExceptions(),
                    ]);
                }

                $e->setResult($model);

                $response = $e->getResponse();
                if (!$response) {
                    $response = new HttpResponse();
                    $response->setStatusCode(500);
                    $e->setResponse($response);
                } else {
                    $statusCode = $response->getStatusCode();
                    if ($statusCode === 200) {
                        $response->setStatusCode(500);
                    }
                }
                break;
        }
    }
}
