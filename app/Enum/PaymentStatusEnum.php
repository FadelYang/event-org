<?php

namespace App\Enum;

enum PaymentStatusEnum: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case CANCEL = 'cancel';

    public static function toArray(): array
    {
        return array_column(PaymentStatusEnum::cases(), 'value');
    }  
}