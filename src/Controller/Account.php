<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class Account implements ControllerInterface
{
    public function render(): Response
    {
        return new Response('Mon Compte');
    }
}
