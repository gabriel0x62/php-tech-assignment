<?php

namespace App\IO\Interfaces;

interface ISerializer
{
    public function serialize(array $data): string;
}
