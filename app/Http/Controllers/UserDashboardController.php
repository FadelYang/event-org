<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService) {
        $this->paymentService = $paymentService;
    }

    public function getUserDashboard($userId)
    {
        $paymentHistories = $this->paymentService->getUserPaymentHistory($userId);

        return view('dashboard', [
            'paymentHistories' => $paymentHistories
        ]);
    }
}
