<?php

namespace App\Enum;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case REGULAR = 'regular';
    case EVENT_ORGINIZER = 'event orginizer';
}