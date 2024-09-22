<?php

declare(strict_types=1);

namespace App\IO;

use App\IO\Interfaces\IDeserializer;

class JsonSerializer implements IDeserializer
{
    public function deserialize(string $data): array
    {
        return json_decode($data, true);
    }
}
