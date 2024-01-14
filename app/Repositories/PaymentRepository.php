<?php

namespace App\Repositories;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentRepository
{
    public function getPaymentByUserId($userId)
    {
        $userId = Auth::user()->id;

        $payments = Payment::where('user_id', $userId)->get();

        return $payments;
    }
}