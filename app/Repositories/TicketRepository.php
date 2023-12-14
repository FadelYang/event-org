<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepositories
{
    public function getTicketByEvent($eventId)
    {
        $eventTicket = Ticket::where('event_id', $eventId)->get();

        return $eventTicket;
    }
}