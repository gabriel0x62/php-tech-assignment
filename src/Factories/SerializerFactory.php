<?php

declare(strict_types=1);

namespace App\Factories;

use App\Enums\InputTypeEnum;
use App\Enums\OutputTypeEnum;
use App\Factories\Interfaces\IDeserializerFactory;
use App\Factories\Interfaces\ISerializerFactory;
use App\IO\CsvSerializer;
use App\IO\Interfaces\IDeserializer;
use App\IO\Interfaces\ISerializer;
use App\IO\JsonSerializer;
use App\IO\XmlSerializer;

class SerializerFactory implements ISerializerFactory, IDeserializerFactory
{
    public function getDeserializer(InputTypeEnum $type): IDeserializer
    {
        return match ($type) {
            InputTypeEnum::JSON => new JsonSerializer(),
            InputTypeEnum::XML => new XmlSerializer(),
        };
    }

    public function getSerializer(OutputTypeEnum $type): ISerializer
    {
        return match ($type) {
            OutputTypeEnum::CSV => new CsvSerializer(),
            OutputTypeEnum::TXT => new CsvSerializer(' '),
        };
    }
}
