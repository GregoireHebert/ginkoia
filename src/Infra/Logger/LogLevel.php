<?php

declare(strict_types=1);

namespace App\Infra\Logger;

enum LogLevel: string
{
    case DEBUG = 'debug';
    case WARNING = 'warning';
    case ERROR = 'error';
    case EMERGENCY = 'emergency';
}
