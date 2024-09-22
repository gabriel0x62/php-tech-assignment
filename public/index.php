<?php

declare(strict_types=1);

use App\Enums\GatewayEnum;

require_once __DIR__ . '/../vendor/autoload.php';

if (empty($_FILES)) {
    header("HTTP/1.1 418 I'm a teapot");
    exit("I'm a teapot");
}

foreach ($_FILES as $key => $file) {
    $gateway = GatewayEnum::tryFrom($key);
    
    if ($gateway) {
        $filePath = realpath("../payment-notifications/{$gateway->getFilename()}");
        file_put_contents($filePath, file_get_contents($file['tmp_name']));
    }
}

// use App\Enums\OutputTypeEnum;
// use App\Services\NotificationHandlerService;

// $handler = new NotificationHandlerService(OutputTypeEnum::CSV);
// $handler->handle();

// $handler = new NotificationHandlerService(OutputTypeEnum::TXT);
// $handler->handle();
