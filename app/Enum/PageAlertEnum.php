<?php

namespace App\Enum;

enum PageAlertEnum: String
{
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case MESSAGE = 'message';
}