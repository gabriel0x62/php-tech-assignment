<?php

declare(strict_types=1);

namespace App\DataObjects;

class RhcpNotification extends GatewayNotification
{
    public static function getFieldNameDateTime(): string
    {
        return 'created';
    }

    public static function getFieldNameStatus(): string
    {
        return 'charge_status';
    }

    public static function getFieldNameAmount(): string
    {
        return 'total_amount';
    }
}
