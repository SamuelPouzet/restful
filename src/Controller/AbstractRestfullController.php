<?php

namespace Samuelpouzet\Restfull\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;

abstract class AbstractRestfullController extends AbstractActionController
{
    final protected function getRequestData(): array
    {
        $input = json_decode(file_get_contents("php://input"), true);
        return array_merge($this->params()->fromPost(), $input);
    }

    final protected function restFullError(int $code, string $message): JsonModel
    {
        $this->getResponse()->setStatusCode($code);
        return new JsonModel([
            'code' => $code,
            'content' => $message,
        ]);
    }

    public function getAction(): JsonModel
    {
        return $this->restFullError(Response::STATUS_CODE_501, 'Method not implemented');
    }

    public function getAllAction(): JsonModel
    {
        return $this->restFullError(Response::STATUS_CODE_501, 'Method not implemented');
    }

    public function postAction(): JsonModel
    {
        return $this->restFullError(Response::STATUS_CODE_501, 'Method not implemented');
    }

    public function putAction(): JsonModel
    {
        return $this->restFullError(Response::STATUS_CODE_501, 'Method not implemented');
    }

    public function patchAction(): JsonModel
    {
        return $this->restFullError(Response::STATUS_CODE_501, 'Method not implemented');
    }

    public function deleteAction(): JsonModel
    {
        return $this->restFullError(Response::STATUS_CODE_501, 'Method not implemented');
    }

    public function optionsAction(): JsonModel
    {
        return $this->restFullError(Response::STATUS_CODE_501, 'Method not implemented');
    }
}
