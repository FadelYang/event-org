<?php

namespace App\Http\Controllers;

use App\Enum\PaymentStatusEnum;
use App\Http\Requests\CreateEventRequest;
use App\Models\Payment;
use App\Services\EventService;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class EventController
{
    protected $eventService;
    protected $ticketService;
    protected $userService;

    public function __construct(EventService $eventService, TicketService $ticketService, UserService $userService)
    {
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
        $this->userService = $userService;
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
        try {
            $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);

            $eventTickets = $this->ticketService->getTicketByEvent($event->id);

            Session::put('event', $event);

            return view('pages.event.detail.index', compact(
                ['event', 'eventTickets']
            ));
        } catch (\Throwable $th) {
            return redirect('home')->with('error-alert', 'Opps..')->with('alert-message', "You can not access this page directly");
        }
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

        $allSelectedTickets = array();

        $totalPrice = 0;

        $event = Session::get('event');

        foreach ($ticketSelected['ticket_selected'] as $ticketId => $totalSelectedTickets) {
            if ($totalSelectedTickets != null) {
                $ticket = $this->ticketService->getTicketById($ticketId);

                if ($ticket->price == null) {
                    $ticket->price = 0;
                }

                $totalPrice = $totalPrice + (intval($ticket->ticket_price) * $totalSelectedTickets);

                $ticketData = [
                    'ticketId' => $ticket->id,
                    'ticketName' => $ticket->name,
                    'ticketPrice' => $ticket->ticket_price,
                    'ticketDate' => $ticket->date,
                    'totalSelectedTickets' => $totalSelectedTickets
                ];

                array_push($allSelectedTickets, $ticketData);
            }
        }

        Session::put('allSelectedTickets', $allSelectedTickets);

        return view('pages.event.checkout.ticket-checkout', [
            'allSelectedTickets' => $allSelectedTickets,
            'event' => $event,
            'orderId' => $orderId,
            'totalPrice' => $totalPrice
        ]);
    }

    public function handleCheckout(Request $request, $orderId)
    {
        $detailCheckoutData = $request->all();

        $detailCustomerData = array();

        $customerData = [
            'customerName' => $detailCheckoutData['customer_name'],
            'customerEmail' => $detailCheckoutData['customer_email'],
            'customerPhone' => $detailCheckoutData['customer_phone'],
            'customerAddress' => $detailCheckoutData['customer_address'],
            'customerNIK' => $detailCheckoutData['customer_NIK'],
        ];

        array_push($detailCustomerData, $customerData);

        $orderId = $detailCheckoutData['order_id'];

        $totalPrice = $detailCheckoutData['total_price'];

        $allSelectedTickets = Session::get('allSelectedTickets');

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
                'item-detail' => json_encode($allSelectedTickets)
            ),
            'customer_details' => array(
                'name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $request->request->add([
            'item_detail' => json_encode($allSelectedTickets),
            'customer_detail' => json_encode($detailCustomerData),
            'order_id' => $orderId,
            'snap_token' => $snapToken,
            'user_id' => Auth::user()->id,
        ]);

        Session::put('orderId', $orderId);

        // it will create new item if refresh
        // need updated_at field in Payment table for got the newest update
        // or update all record by order_id
        $payment = Payment::create($request->all());

        return view('pages.event.checkout.main-checkout', [
            'payment' => $payment,
            'totalPrice' => $totalPrice,
            'snapToken' => $snapToken,
            'orderId' => $orderId,
            'allSelectedTickets' => $allSelectedTickets,
            'detailCustomerData' => $detailCustomerData,
        ]);
    }

    public function handleSuccessTransaction()
    {
        return redirect('home')->with('success-alert', 'Payment Success')->with('alert-message', 'You can check your detail payment here');
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == PaymentStatusEnum::PENDING->value) {
                $payment = Payment::where('order_id', $request->order_id)->first();
                $payment->update(['status' => 'success']);
            }
        }

        return redirect('home')->with('success-alert', 'Payment Success')->with('alert-message', 'You can check your detail payment here');
    }

    public function getCreateBasicEventPage()
    {
        return view('pages.event.create.create-basic-event');
    }

    public function getCreateTicketPage(CreateEventRequest $request)
    {
        try {
            $requestData = $request->all();

            $request->validated();

            $slug = Str::slug($request->title . rand());

            $requestData['user_id'] = Auth::user()->id;

            $requestData['slug'] = $slug;

            // handle store image
            if ($request->potrait_banner) {
                $potraitBannerName = time() . '.' . $request->potrait_banner->extension();

                $requestData['potrait_banner'] = $potraitBannerName;

                $request->potrait_banner->move(public_path('images/potraitBanner'), $potraitBannerName);
            }

            if ($request->landscape_banner) {
                $landscapeBannerName = time() . '.' . $request->landscape_banner->extension();

                $requestData['landscape_banner'] = $landscapeBannerName;

                $request->landscape_banner->move(public_path('images/landscapeBanner'), $landscapeBannerName);
            }

            $userId = Auth::user()->id;

            $request->merge([
                'user_id' => $userId,
                'slug' => $slug
            ]);

            $this->eventService->createEvent($requestData);

            Session::flash('success-alert', 'Create Event Success');

            Session::flash('alert-message', 'create event success, please add detail ticket here');

            $event = $this->eventService->getLatestCreatedEventByUser($userId);

            $eventSlug = $event->slug;

            return view('pages.event.create.create-ticket', [
                'event' => $event,
            ]);
        } catch (\Throwable $th) {
            $event = $this->eventService->getLatestCreatedEventByUser($userId);

            return view('pages.event.create.create-ticket', [
                'event' => $event,
            ])->with('success-alert', 'Create Event Success')->with('alert-message', 'create event success, please add detail ticket here');
        }
    }

    public function finishEvent($eventId)
    {
        $event = $this->eventService->getEventById($eventId);

        $eventParticipants = $event->participants->all();

        if (count($eventParticipants) != 0) {
            foreach ($eventParticipants as $eventParticipant) {
                $totalExp = $eventParticipant->ticketOwner->exp + ($eventParticipant->total_price * 0.01);

                $this->userService->addUserExpAfterFinishEvent($eventParticipant->user_id, $totalExp);
            }
        }

        $this->eventService->finishEvent($eventId);

        return back()->with('success-alert', 'Finish Event Success')->with('alert-message', 'event kamu sudah dinyatakan selesai, terimakasih');
    }
}
