<?php

namespace App\Http\Controllers;

use App\Enum\EventCuratedStatusEnum;
use App\Services\EventService;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    protected $eventService;
    protected $ticketService;
    protected $userService;

    public function __construct(EventService $eventService, TicketService $ticketService, UserService $userService) {
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

    public function forms()
    {
        return view('admin.index');
    }

    public function cards()
    {
        return view('admin.index');
    }
}
