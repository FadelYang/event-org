<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository
{
    public function getTicketByEvent($eventId)
    {
        $eventTicket = Ticket::where('event_id', $eventId)->get();

        return $eventTicket;
    }
}