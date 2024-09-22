<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\GatewayEnum;
use App\Enums\OutputTypeEnum;
use App\Factories\GatewayNotificationFactory;
use App\Factories\SerializerFactory;
use Exception;

class NotificationHandlerService
{
    public function __construct(
        private OutputTypeEnum $outputType
    ) {
    }

    public function handle(): void
    {
        /** @var \App\DataObjects\GatewayNotification[] $notifications */
        $notifications = [];

        $notificationFactory = new GatewayNotificationFactory(new SerializerFactory());
        foreach (GatewayEnum::cases() as $gateway) {
            try {
                $filePath = realpath("../payment-notifications/{$gateway->getFilename()}");
                if ($filePath) {
                    $fileContent = file_get_contents($filePath);
                    $notifications[] = $notificationFactory->create($fileContent, $gateway);
                }
            } catch (Exception $e) {
                // log
            }
        }

        // TODO
    }
}
