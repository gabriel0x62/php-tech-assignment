<?php

declare(strict_types=1);

namespace App\IO;

use App\IO\Interfaces\ISerializer;

class CsvSerializer implements ISerializer
{
    public function __construct(
        public readonly string $delimiter = ','
    ) {
    }

    /**
     * @param array<array<string, string>> $data
     */
    public function serialize(array $data): string
    {
        //header
        $content = implode($this->delimiter, array_keys($data[0]));

        foreach ($data as $row) {
            $entry = implode($this->delimiter, $row);
            $content .= "\n{$entry}";
        }

        return $content;
    }
}
