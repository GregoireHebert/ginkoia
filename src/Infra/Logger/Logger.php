<?php

declare(strict_types=1);

namespace App\Infra\Logger;

final class Logger implements LoggerInterface
{
    public function log(string $message, LogLevel $level): void
    {
        $path = PROJECT_ROOT . '/var/' . $level->value . '.log';
        $resource = fopen($path, 'ab');

        $dateTime = (new \DateTimeImmutable('now'))->format(DATE_ATOM);

        fwrite($resource, sprintf('[%s] %s %s',$dateTime, $message, PHP_EOL));
        fclose($resource);
    }
}
