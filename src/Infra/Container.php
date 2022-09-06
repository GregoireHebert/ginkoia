<?php

declare(strict_types=1);

namespace App\Infra;

class Container
{
    private array $servicesAvailable = [];

    private array $servicesInstances = [];

    public function add(string $serviceName, string|object $class): void
    {
        if (is_object($class)) {
            $this->servicesInstances[$serviceName] = $class;
            return;
        }

        $this->servicesAvailable[$serviceName] = $class;
    }

    public function get(string $serviceName): object
    {
        if (isset($this->servicesInstances[$serviceName])) {
            return $this->servicesInstances[$serviceName];
        }

        if (isset($this->servicesAvailable[$serviceName])) {

            $reflectionController = new \ReflectionClass($serviceName);
            $arguments = [];
            foreach ($reflectionController->getConstructor()?->getParameters() ?? [] as $parameter) {
                $arguments[$parameter->getName()] = $this->get($parameter->getType()?->getName());
            }

            $this->servicesInstances[$serviceName] = new $this->servicesAvailable[$serviceName]($arguments);
            return $this->servicesInstances[$serviceName];
        }

        throw new \LogicException('unknown service '.$serviceName);
    }
}
