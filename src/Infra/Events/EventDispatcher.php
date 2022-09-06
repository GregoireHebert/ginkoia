<?php

declare(strict_types=1);

namespace App\Infra\Events;

class EventDispatcher
{
    private array $eventListeners = [];

    public function addListener(string $event, object $listener)
    {
        $this->eventListeners[$event][] = $listener;
    }

    public function dispatch(Event $event)
    {
        foreach ($this->eventListeners[$event::class] as $eventListener) {
            $eventListener->execute($event);
        }
    }
}
