<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function getTicketByEvent($eventId)
    {
        $eventTickets = $this->ticketService->getTicketByEvent($eventId);

        return view('pages.event.detail.index', ['eventTicket' => $eventTickets]);
    }

    public function createTicketForEvent(Request $request)
    {
        dd($request);
    }
}
