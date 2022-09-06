<?php

declare(strict_types=1);

namespace App\Infra\Events;

use App\Controller\ControllerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ControllerEvent implements Event
{
    private ?Response $response = null;

    public function __construct(private ControllerInterface $controller, private Request $request)
    {
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setController(ControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }
}
