<?php

declare(strict_types=1);

namespace App\Infra\Logger;

interface LoggerInterface
{
    /**
     * write or send a log
     */
    public function log(string $message, LogLevel $level): void;
}
