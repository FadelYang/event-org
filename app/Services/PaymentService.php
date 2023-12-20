<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository) {
        $this->paymentRepository = $paymentRepository;
    }

    public function getUserPaymentHistory($userId)
    {
        $payments = $this->paymentRepository->getPaymentByUserId($userId);

        return $payments;
    }
}