<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Enums\OutputTypeEnum;
use App\Services\NotificationHandlerService;

$handler = new NotificationHandlerService(OutputTypeEnum::CSV);
$handler->handle();

$handler = new NotificationHandlerService(OutputTypeEnum::TXT);
$handler->handle();
