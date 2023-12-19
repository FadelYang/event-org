<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\Ticket;
use App\Services\EventService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

        Session::put('event', $event);

        return view('pages.event.detail.index', compact(
            ['event', 'eventTickets']
        ));
    }

    public function createEvent()
    {
        return view('pages.event.create.create-event');
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
        $orderId = Str::orderedUuid();

        Session::put('ticketCheckoutDetails', $eventDates);
        Session::put('totalPrice', $totalPrice);
        Session::put('orderId', $orderId);

        return view('pages.event.checkout.ticket-checkout', [
            'event' => $event,
            'eventDetails' => $eventDetail,
            'ticketCheckoutDetails' => $eventDates,
            'totalTicket' => $totalTicket,
            'totalPrice' => $totalPrice,
            'orderId' => $orderId,
            'ticketId' => $request->ticket_id
        ]);
    }

    public function handleCheckout(Request $request, $orderId)
    {
        $eventDates = Session::get('ticketCheckoutDetails');
        $orderId = Session::get('orderId');
        $totalPrice = Session::get('totalPrice');

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
                'item-detail' => json_encode($eventDates)
            ),
            'customer_details' => array(
                'name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $request->request->add([
            'item_detail' => json_encode($eventDates),
            'order_id' => $orderId,
            'snap_token' => $snapToken
        ]);

        $payment = payment::create($request->all());


        return view('pages.event.checkout.main-checkout', compact('payment', 'snapToken', 'orderId'));
    }
}
