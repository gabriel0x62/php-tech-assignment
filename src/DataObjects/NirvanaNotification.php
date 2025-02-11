<?php

declare(strict_types=1);

namespace App\DataObjects;

class NirvanaNotification extends GatewayNotification
{
    public static function getFieldNameDateTime(): string
    {
        return 'created_at';
    }

    public static function getFieldNameStatus(): string
    {
        return 'status';
    }

    public static function getFieldNameAmount(): string
    {
        return 'amount_received';
    }
}
