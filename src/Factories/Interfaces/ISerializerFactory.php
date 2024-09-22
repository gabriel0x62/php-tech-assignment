<?php

namespace App\Factories\Interfaces;

use App\Enums\OutputTypeEnum;
use App\IO\Interfaces\ISerializer;

interface ISerializerFactory
{
    public function getSerializer(OutputTypeEnum $type): ISerializer;
}
