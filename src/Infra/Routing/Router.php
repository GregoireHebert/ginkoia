<?php

declare(strict_types=1);

namespace App\Infra\Routing;

use App\Controller\Account;
use App\Controller\ControllerInterface;
use App\Controller\Error404;
use App\Controller\Home;

class Router
{
    private array $routes = [
      '/' => Home::class,
      '/account' => Account::class,
      '404' => Error404::class,
    ];

    public function getController(string $pathInfo): string
    {
        return $this->routes[$pathInfo] ?? $this->routes['404'];
    }
}
