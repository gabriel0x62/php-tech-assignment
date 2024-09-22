<?php

declare(strict_types=1);

namespace App\IO;

use App\IO\Interfaces\IDeserializer;
use SimpleXMLElement;

class XmlSerializer implements IDeserializer
{
    /** @return array<string, mixed> */
    public function deserialize(string $data): array
    {
        $result = [];

        $xml = new SimpleXMLElement($data);

        if (count($xml->children()) > 0) {
            foreach ($xml->children() as $node) {
                if (count($node->children()) == 0) {
                    $result[$node->getName()] = ctype_digit($node->__toString())
                        ? intval($node->__toString())
                        : $node->__toString();
                }
            }
        }

        return $result;
    }
}
