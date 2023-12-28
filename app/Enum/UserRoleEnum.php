<?php

namespace App\Enum;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case REGULAR = 'regular';
    case EVENT_ORGINIZER = 'event orginizer';

    public static function toArray(): array
    {
        return array_column(UserRoleEnum::cases(), 'value');
    }  
}