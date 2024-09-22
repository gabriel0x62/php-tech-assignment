<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataObjects\GatewayNotification;
use App\DataObjects\NirvanaNotification;
use App\Enums\GatewayEnum;
use App\Factories\Interfaces\IDeserializerFactory;
use Exception;

class GatewayNotificationFactory
{
    public function __construct(
        private readonly IDeserializerFactory $deseralizerFactory
    ) {
    }

    public function create(string $content, GatewayEnum $gateway): GatewayNotification
    {
        $data = $this->deseralizerFactory->getDeserializer($gateway->getDataType())->deserialize($content);

        $notification = null;

        switch ($gateway) {
            case GatewayEnum::NIRVANA:
                $notification = new NirvanaNotification($data);
                break;

            default:
                throw new Exception("Unknown notification type");
        }

        return $notification;
    }
}
