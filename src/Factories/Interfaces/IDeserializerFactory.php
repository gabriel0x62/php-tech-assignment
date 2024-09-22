<?php

namespace App\Factories\Interfaces;

use App\Enums\InputTypeEnum;
use App\IO\Interfaces\IDeserializer;

interface IDeserializerFactory
{
    public function getDeserializer(InputTypeEnum $type): IDeserializer;
}
