<?php

namespace App\Services;

use App\Repositories\TicketRepository;

class TicketService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getTicketByEvent($eventId)
    {
        $eventTicket = $this->ticketRepository->getTicketByEvent($eventId);

        return $eventTicket;
    }
}