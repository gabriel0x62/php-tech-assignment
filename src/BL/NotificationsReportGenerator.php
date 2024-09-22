<?php

declare(strict_types=1);

namespace App\BL;

use App\IO\Interfaces\ISerializer;

class NotificationsReportGenerator
{
    public function __construct(
        private readonly ISerializer $serializer
    ) {
    }

    /**
     * @param \App\DataObjects\GatewayNotification[] $notifications
     **/
    public function generateReportContent(array $notifications): string
    {
        $rows = [];

        foreach ($notifications as $notification) {
            $rows[] = [
                'date_time' => $notification->datetime->format('Y-m-d H:i:s'),
                'status' => $notification->status,
                'total' => $notification->amount,
            ];
        }

        return $this->serializer->serialize($rows);
    }
}
