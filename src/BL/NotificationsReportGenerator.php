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
                'date_time' => $notification->datetime,
                'status' => $notification->status,
                'total' => $notification->total,
            ];
        }

        return $this->serializer->serialize($rows);
    }
}
