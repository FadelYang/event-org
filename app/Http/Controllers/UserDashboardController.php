<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    protected $paymentService;
    protected $eventService;

    public function __construct(PaymentService $paymentService, EventService $eventService) {
        $this->paymentService = $paymentService;
        $this->eventService = $eventService;
    }

    public function getUserDashboard($userId)
    {
        $paymentHistories = $this->paymentService->getUserPaymentHistory($userId);
        $createEventHistories = $this->eventService->getEventByUserId($userId);
        // dd($createEventHistories->all());

        return view('dashboard', [
            'paymentHistories' => $paymentHistories,
            'createEventHistories' => $createEventHistories,
        ]);
    }
}
