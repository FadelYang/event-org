<?php

namespace App\Services;

class TicketService
{
    protected $ticketService;

    public function __construct(TicketService $ticketService) {
        $this->ticketService = $ticketService;
    }

    public function getTicketByEvent($eventId)
    {
        $eventTicket = $this->getTicketByEvent($eventId);

        return $eventTicket;
    }
}