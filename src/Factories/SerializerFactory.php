<?php

declare(strict_types=1);

namespace App\Factories;

use App\Enums\InputTypeEnum;
use App\Factories\Interfaces\IDeserializerFactory;
use App\IO\Interfaces\IDeserializer;
use App\IO\JsonSerializer;

class SerializerFactory implements IDeserializerFactory
{
    public function getDeserializer(InputTypeEnum $type): IDeserializer
    {
        return match ($type) {
            InputTypeEnum::JSON => new JsonSerializer(),
            // TODO
        };
    }
}
