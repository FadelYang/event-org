<?php

namespace App\Http\Controllers;

use App\Enum\PaymentStatusEnum;
use App\Models\payment;
use App\Models\Ticket;
use App\Services\EventService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $ticketSelected = $request->all();

        $orderId = rand();

        $allTicketSelected = array();

        $totalPrice = 0;

        $event = Session::get('event');

        foreach ($ticketSelected['ticket_selected'] as $ticketId => $totalTicketSelected) {
            if ($totalTicketSelected != null) {
                $ticket = $this->ticketService->getTicketById($ticketId);

                if ($ticket->price == null)  {
                    $ticket->price = 0;
                }
                
                $totalPrice = $totalPrice + (intval($ticket->ticket_price) * $totalTicketSelected);

                $ticketData = [
                    'ticketName' => $ticket->name,
                    'ticketPrice' => $ticket->ticket_price,
                    'ticketDate' => $ticket->date,
                    'totalTicketSelected' => $totalTicketSelected
                ];

                array_push($allTicketSelected, $ticketData);
            }
        }

        return view('pages.event.checkout.ticket-checkout', [
            'allTicketSelected' => $allTicketSelected,
            'event' => $event,
            'orderId' => $orderId,
            'totalPrice' => $totalPrice
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
            'snap_token' => $snapToken,
            'user_id' => Auth::user()->id,
        ]);

        Session::put('orderId', $orderId);

        $payment = payment::create($request->all());

        return view('pages.event.checkout.main-checkout', compact('payment', 'snapToken', 'orderId'));
    }

    public function handleSuccessTransaction($orderId)
    {
        $orderId = Session::get('orderId');

        $order = Payment::where('order_id', $orderId)->first();

        $order->status = PaymentStatusEnum::SUCCESS->value;

        $order->save();

        return redirect('home')->with('success-alert', 'Payment Success')->with('alert-message', 'You can check your detail payment here');
    }

    public function getCreateBasicEventPage()
    {
        return view('pages.event.create.create-basic-event');
    }
}
