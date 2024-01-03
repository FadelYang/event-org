<?php

namespace App\Enum;

enum EventCuratedStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECT = 'reject';

    public static function toArray(): array
    {
        return array_column(EventCuratedStatusEnum::cases(), 'value');
    }  
}