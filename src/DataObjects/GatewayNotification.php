<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\DataObjects\Interfaces\IExternalNotification;
use DateTimeImmutable;

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
        $datetime = DateTimeImmutable::createFromFormat('Y-m-d\\TH:i:sp', $data[static::getFieldNameDateTime()]);

        if (!$datetime) {
            throw new \InvalidArgumentException('DateTime is invalid');
        }

        return new static(
            $datetime,
            $data[static::getFieldNameStatus()],
            $data[static::getFieldNameAmount()]
        );
    }
}
