<?php

declare(strict_types=1);

namespace App\Enums;

enum NotificationStatusEnum: string
{
    case PAID = 'paid';
    case UNKNOWN = 'unknown';
}
