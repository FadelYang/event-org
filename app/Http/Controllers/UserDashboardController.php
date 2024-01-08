<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubmittedEventRequest;
use App\Services\EventService;
use App\Services\PaymentService;
use App\Services\TicketService;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    protected $paymentService;
    protected $eventService;
    protected $ticketService;

    public function __construct(PaymentService $paymentService, EventService $eventService, TicketService $ticketService)
    {
        $this->paymentService = $paymentService;
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
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

    public function getDetailSubmittedEvent($username, $eventType, $eventSlug)
    {
        $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);

        $eventTickets = $this->ticketService->getTicketByEvent($event->id);

        return view('profile.dashboard.event-detail', [
            'event' => $event,
            'eventTickets' => $eventTickets,
        ]);
    }

    public function getUpdatedSubmittedEventPage($username, $eventType, $eventSlug)
    {
        $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);

        $eventTickets = $this->ticketService->getTicketByEvent($event->id);

        return view('profile.dashboard.event-update', [
            'event' => $event,
            'eventTickets' => $eventTickets,
        ]);
    }

    public function updateSubmittedEvent(UpdateSubmittedEventRequest $request, $eventId)
    {
        try {
            dd($request);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
