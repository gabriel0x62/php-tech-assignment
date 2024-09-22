<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\DataObjects\Interfaces\IExternalNotification;
use App\Enums\NotificationStatusEnum;
use DateTimeImmutable;

abstract class GatewayNotification implements IExternalNotification
{
    // public properties for simplicity
    final public function __construct(
        public readonly \DateTimeImmutable $datetime,
        public readonly NotificationStatusEnum $status,
        public readonly int $amount
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function createFromExternal(array $data): static
    {
        $datetime = DateTimeImmutable::createFromFormat('Y-m-d\\TH:i:sp', $data[static::getFieldNameDateTime()]);

        if (!$datetime) {
            throw new \InvalidArgumentException('DateTime is invalid');
        }

        $status = in_array($data[static::getFieldNameStatus()], ['succeeded', 'successful', 'completed']) ? NotificationStatusEnum::PAID : NotificationStatusEnum::UNKNOWN;

        return new static(
            $datetime,
            $status,
            $data[static::getFieldNameAmount()],
        );
    }
}
