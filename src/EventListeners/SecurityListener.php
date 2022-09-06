<?php

declare(strict_types=1);

namespace App\EventListeners;

use App\Infra\Events\ControllerEvent;
use Symfony\Component\HttpFoundation\Response;

class SecurityListener
{
    public function execute(ControllerEvent $event)
    {
        $token = $event->getRequest()->get('token');

        if ($token === null) {
            $event->setResponse(new Response('forbidden', 401));
        }
    }
}
