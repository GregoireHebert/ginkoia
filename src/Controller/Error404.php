<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class Error404 implements ControllerInterface
{
    public function render(): Response
    {
        return new Response('404', 404);
    }
}
