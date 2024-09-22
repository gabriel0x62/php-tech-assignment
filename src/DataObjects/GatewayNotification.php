<?php

declare(strict_types=1);

namespace App\DataObjects;

abstract class GatewayNotification
{
    // public properties for simplicity
    public function __construct(
        public readonly \DateTimeImmutable $datetime,
        public readonly string $status,
        public readonly string $total
    ) {
    }
}
