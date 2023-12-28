<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService) {
        $this->paymentService = $paymentService;
    }

    public function getUserPaymentHistory($userId)
    {
        $payments = $this->paymentService->getUserPaymentHistory($userId);

        return view('dashboard', [
            'payments' => $payments
        ]);
    }
}
