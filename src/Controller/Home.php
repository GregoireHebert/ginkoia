<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class Home implements ControllerInterface
{
    public function render(): Response
    {
        return new Response('Home');
    }
}
