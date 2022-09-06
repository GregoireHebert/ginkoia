<?php

declare(strict_types=1);

const PROJECT_ROOT = __DIR__.'/..';

require_once PROJECT_ROOT . '/vendor/autoload.php';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$router = new App\Infra\Routing\Router();
$controller = $router->getController($request->getPathInfo());

$response = $controller->render();
$response->send();

exit(0);
