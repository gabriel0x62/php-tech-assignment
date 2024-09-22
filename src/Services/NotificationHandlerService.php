<?php

declare(strict_types=1);

namespace App\Services;

use App\BL\NotificationsReportGenerator;
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

        $serializerFactory = new SerializerFactory();
        $notificationFactory = new GatewayNotificationFactory($serializerFactory);
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

        $reportContent = (new NotificationsReportGenerator(
            $serializerFactory->getSerializer($this->outputType)
        ))->generateReportContent($notifications);
        
        $filePath = implode(DIRECTORY_SEPARATOR, ['.', "output.{$this->outputType}"]);
        file_put_contents($filePath, $reportContent);
    }
}
