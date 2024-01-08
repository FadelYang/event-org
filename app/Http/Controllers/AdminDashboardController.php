<?php

namespace App\Http\Controllers;

use App\Enum\EventCuratedStatusEnum;
use App\Http\Requests\RejectSubmittedEventRequest;
use App\Services\EventService;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminDashboardController extends Controller
{
    protected $eventService;
    protected $ticketService;
    protected $userService;

    public function __construct(EventService $eventService, TicketService $ticketService, UserService $userService)
    {
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
        $this->userService = $userService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvent();

        $tickets = $this->ticketService->getAllTicket();

        $users = $this->userService->getAllUser();

        $approveCuratedEvents = $events->where('status', EventCuratedStatusEnum::APPROVED->value);

        $pendingCuratedEvents = $events->where('status', EventCuratedStatusEnum::PENDING->value);

        $publishEvents = $approveCuratedEvents->where('is_publish', true);

        return view('admin.index', [
            'approveCuratedEvents' => $approveCuratedEvents,
            'pendingCuratedEvents' => $pendingCuratedEvents,
            'publishEvents' => $publishEvents,
            'tickets' => $tickets,
            'users' => $users,
            'events' => $events,
        ]);
    }

    public function getDetailSubmittedEvent($eventType, $eventSlug)
    {
        $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);

        $eventTickets = $this->ticketService->getTicketByEvent($event->id);

        return view('admin.pages.event.detail-event', [
            'event' => $event,
            'eventTickets' => $eventTickets,
        ]);
    }

    public function approveAndPublishEvent($eventId)
    {
        $event = $this->eventService->getEventById($eventId);

        try {
            $this->eventService->approveEvent($event->id);
            $this->eventService->publishEvent($event->id);

            return back()->with('success-alert', 'Update Event Success')->with('alert-message', 'sukses mengkruasi dan menayangkan event');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error-alert', 'Update Event Fail')->with('alert-message', 'ada kendala, gagal mengkurasi dan menayangkan event');
        }
    }

    public function rejectSubmittedEvent(RejectSubmittedEventRequest $request, $eventId)
    {
        try {
            $requestData = $request->validated();

            $cancelStatement = $requestData['cancel_statement'];

            $this->eventService->rejectSubmittedEvent($eventId, $cancelStatement);

            return back()->with('success-alert', 'Reject Event Success')->with('alert-message', 'sukses menolak pendaftaran event, pengguna akan diberitahu untuk memperbaiki data');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error-alert', 'Reject Event Fail')->with('alert-message', 'ada kendala, gagal menolak pendaftaran event');
        }
    }
}
