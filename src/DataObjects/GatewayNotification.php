<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\DataObjects\Interfaces\IExternalNotification;

abstract class GatewayNotification implements IExternalNotification
{
    // public properties for simplicity
    final public function __construct(
        public readonly \DateTimeImmutable $datetime,
        public readonly string $status,
        public readonly string $amount
    ) {
    }

    public static function createFromExternal(array $data): static
    {
        return new static(
            $data[static::getFieldNameDateTime()],
            $data[static::getFieldNameStatus()],
            $data[static::getFieldNameAmount()]
        );
    }
}
