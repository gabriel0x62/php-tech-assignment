<?php

namespace App\IO\Interfaces;

interface ISerializer
{
    /** @param array<array<string, mixed>> $data */
    public function serialize(array $data): string;
}
