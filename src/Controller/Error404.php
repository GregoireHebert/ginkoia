<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infra\Logger\LoggerInterface;
use App\Infra\Logger\LogLevel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Error404 implements ControllerInterface
{
    public function __construct(private readonly LoggerInterface $logger, private readonly Request $request)
    {
    }

    public function render(): Response
    {
        $this->logger->log('Route non trouvée : '. $this->request->getPathInfo(), LogLevel::ERROR);
        return new Response('404', 404);
    }
}
