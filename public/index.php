<?php

declare(strict_types=1);

const PROJECT_ROOT = __DIR__.'/..';

require_once PROJECT_ROOT . '/vendor/autoload.php';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$router = new App\Infra\Routing\Router();
$controllerName = $router->getController($request->getPathInfo());

if (!is_a($controllerName, \App\Controller\ControllerInterface::class, true)) {
    throw new LogicException('Controller '.$controllerName.' is not a '.\App\Controller\ControllerInterface::class);
}

$container = new \App\Infra\Container();
$container->add(\App\Infra\Logger\LoggerInterface::class, \App\Infra\Logger\Logger::class);
$container->add(\App\Infra\Mailer\Mailer::class, \App\Infra\Mailer\Mailer::class);
$container->add( \Symfony\Component\HttpFoundation\Request::class, $request);

$reflectionController = new ReflectionClass($controllerName);
$arguments = [];
foreach ($reflectionController->getConstructor()?->getParameters() ?? [] as $parameter) {
    $arguments[$parameter->getName()] = $container->get($parameter->getType()?->getName());
}

$controller = new $controllerName(...$arguments);

$eventDispatcher = new \App\Infra\Events\EventDispatcher();
$eventDispatcher->addListener(\App\Infra\Events\ControllerEvent::class, new \App\EventListeners\SecurityListener());

$controllerEvent = new \App\Infra\Events\ControllerEvent($controller, $request);
$eventDispatcher->dispatch($controllerEvent);

if(null === $response = $controllerEvent->getResponse()) {
    $controller = $controllerEvent->getController();
    $response = $controller->render();
}

$response->send();

exit(0);
