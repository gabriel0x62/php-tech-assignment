<?php

namespace App\IO\Interfaces;

interface IDeserializer
{
    public function deserialize(string $string): array;
}
