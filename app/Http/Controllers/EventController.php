<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\EventService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController
{
    protected $eventService;
    protected $ticketService;

    public function __construct(EventService $eventService, TicketService $ticketService)
    {
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
    }

    public function getAllEventPage()
    {
        $events = $this->eventService->getAllEvent();

        return view('pages.event.index', [
            'events' => $events
        ]);
    }

    public function getEventDetail($eventType, $eventSlug)
    {
        $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);

        return $event;
    }

    public function getEventDetailPage($eventType, $eventSlug)
    {
        $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);
        $eventTickets = $this->ticketService->getTicketByEvent($event->id);

        Session::flash('event', $event);


        return view('pages.event.detail.index', compact(
            ['event', 'eventTickets']
        ));
    }

    public function getEventsByTypePage($eventType)
    {
        $events = $this->eventService->getEventByType($eventType);

        return view('pages.event.type', [
            'events' => $events
        ]);
    }

    public function getTicketCheckoutPage(Request $request)
    {
        $data = $request->all();

        $event = Session::get('event');

        $eventDetail = [
            'eventName' => $data['event_name'],
            'ticketName' => $data['ticket_name'],
            'ticketType' => $data['ticket_type'],
        ];

        $eventDates = array();

        $totalTicket = 0;
        $ticketPrice = $data['ticket_price'];

        foreach ($data['days'] as $key => $day) {
            if ($day != null) {
                $totalTicket = $totalTicket + $day;
                $formattedDate = date('D, d M Y', strtotime($data["event_date"] . ' + ' . $key . ' days'));
                array_push(
                    $eventDates,
                    [
                        'ticket_quantity' => $day,
                        'event_date' => $formattedDate
                    ]
                );
            }
        }

        $totalPrice = $totalTicket * $ticketPrice;

        Session::flash('eventDetails', $eventDetail);
        Session::flash('ticketCheckoutDetails', $eventDates);
        Session::flash('totalTicket', $totalTicket);
        Session::flash('totalPrice', $totalPrice);    

        return view('pages.event.checkout.ticket-checkout', [
            'event' => $event,
            'eventDetails' => $eventDetail,
            'ticketCheckoutDetails' => $eventDates,
            'totalTicket' => $totalTicket, 
            'totalPrice' => $totalPrice
        ]);
    }
}
