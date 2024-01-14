<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController
{
    protected $ticketService;
    protected $eventService;

    public function __construct(TicketService $ticketService, EventService $eventService)
    {
        $this->ticketService = $ticketService;
        $this->eventService = $eventService;
    }

    public function getTicketByEvent($eventId)
    {
        $eventTickets = $this->ticketService->getTicketByEvent($eventId);

        return view('pages.event.detail.index', ['eventTicket' => $eventTickets]);
    }

    public function createTicketForEvent(Request $request)
    {
        $requestData = $request->all();

        $event = $this->eventService->getEventById($requestData['event_id']);

        try {
            for ($i = 0; $i < count($request['name']); $i++) {
                $createTicketRequestData = [
                    'name' => $requestData['name'][$i],
                    'date' => $requestData['date'][$i],
                    'ticket_price' => $requestData['ticket_price'][$i],
                    'quantity' => $requestData['quantity'][$i],
                    'is_all_day_pass' => $requestData['access_checked'],
                    'event_id' => $requestData['event_id'],
                ];

                $this->ticketService->createTicketForEvent($createTicketRequestData);
            }

            return redirect('home')->with('success-alert', 'Create Ticket Success')->with('alert-message', 'You can check your ticket detail in your dashboard');
        } catch (\Throwable $th) {
            return redirect('ticket.create', $event->slug)
                ->with('error-alert', 'Opps..')
                ->with('alert-message', 'something when wrong, please try again');
        }
    }
}
