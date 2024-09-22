<?php

namespace App\IO\Interfaces;

interface IDeserializer
{
    /** @return array<string, mixed> */
    public function deserialize(string $string): array;
}
