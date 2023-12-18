<?php

namespace App\Http\Controller;

use App\Services\TicketService;

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
}
