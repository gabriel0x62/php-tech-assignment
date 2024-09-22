<?php

declare(strict_types=1);

namespace App\Enums;

enum InputTypeEnum: string
{
    case JSON = 'json';
    case XML = 'xml';
}
