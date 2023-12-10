<?php

namespace App\Enum;

enum EventTypeEnum: string
{
    case SEMINAR = 'seminar';
    case PELATIHAN = 'pelatihan';

    public static function toArray(): array
    {
        return array_column(EventTypeEnum::cases(), 'value');
    }  
}