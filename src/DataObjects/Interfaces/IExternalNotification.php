<?php

namespace App\DataObjects\Interfaces;

interface IExternalNotification
{
    public static function getFieldNameDateTime(): string;
    public static function getFieldNameStatus(): string;
    public static function getFieldNameAmount(): string;
}