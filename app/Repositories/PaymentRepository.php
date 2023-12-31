<?php

namespace App\Repositories;

use App\Models\payment;
use Illuminate\Support\Facades\Auth;

class PaymentRepository
{
    public function getPaymentByUserId($userId)
    {
        $userId = Auth::user()->id;

        $payments = payment::where('user_id', $userId)->get();

        return $payments;
    }
}