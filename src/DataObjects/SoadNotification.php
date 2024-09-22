<?php

declare(strict_types=1);

namespace App\DataObjects;

class SoadNotification extends GatewayNotification
{
    public static function getFieldNameDateTime(): string
    {
        return 'timestamp';
    }

    public static function getFieldNameStatus(): string
    {
        return 'transaction_status';
    }

    public static function getFieldNameAmount(): string
    {
        return 'amount';
    }
}
