<?php

declare(strict_types=1);

namespace App\Enums;

enum GatewayEnum: string
{
    case NIRVANA = 'nirvana';
    case RHCP = 'rhcp';
    case SOAD = 'soad';

    public function getDataType(): InputTypeEnum
    {
        return match ($this) {
            GatewayEnum::NIRVANA, GatewayEnum::SOAD => InputTypeEnum::JSON,
            GatewayEnum::RHCP => InputTypeEnum::XML,
        };
    }

    public function getFilename(): string
    {
        return "{$this->value}-gateway.{$this->getDataType()->value}";
    }
}
