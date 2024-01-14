<?php

namespace App\Http\Controllers;

use App\Enum\EventCuratedStatusEnum;
use App\Http\Requests\UpdateSubmittedEventRequest;
use App\Services\EventService;
use App\Services\PaymentService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserDashboardController extends Controller
{
    protected $paymentService;
    protected $eventService;
    protected $ticketService;

    public function __construct(PaymentService $paymentService, EventService $eventService, TicketService $ticketService)
    {
        $this->paymentService = $paymentService;
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
    }

    public function getUserDashboard($userId)
    {
        $paymentHistories = $this->paymentService->getUserPaymentHistory($userId);
        $createEventHistories = $this->eventService->getEventByUserId($userId);
        // 

        return view('dashboard', [
            'paymentHistories' => $paymentHistories,
            'createEventHistories' => $createEventHistories,
        ]);
    }

    public function getDetailSubmittedEvent($username, $eventType, $eventSlug)
    {
        $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);

        $eventTickets = $this->ticketService->getTicketByEvent($event->id);

        // foreach ($eventParticipants as $value) {
        //     dd(json_decode($value->item_detail)[0]);
        // }

        return view('profile.dashboard.event-detail', [
            'event' => $event,
            'eventTickets' => $eventTickets,
            'eventParticipants' => $event->participants,
            'rowNumber' => 1 
        ]);
    }

    public function getUpdatedSubmittedEventPage($username, $eventType, $eventSlug)
    {
        $event = $this->eventService->getEventByTypeAndSlug($eventType, $eventSlug);

        $eventTickets = $this->ticketService->getTicketByEvent($event->id);

        return view('profile.dashboard.event-update', [
            'event' => $event,
            'eventTickets' => $eventTickets,
        ]);
    }

    public function updateSubmittedEvent(UpdateSubmittedEventRequest $request, $eventId)
    {
        $event = $this->eventService->getEventById($eventId);

        try {
            $requestData = $request->validated();

            if ($request->potrait_banner) {
                $potraitBannerName = time() . '.' . $request->potrait_banner->extension();

                $requestData['potrait_banner'] = $potraitBannerName;

                if ($event->potrait_banner != null) {
                    File::delete(public_path('images/potraitBanner/'. $event->potrait_banner));
                }

                $request->potrait_banner->move(public_path('images/potraitBanner/'), $potraitBannerName);
            }

            if ($request->landscape_banner) {
                $landscapeBannerName = time() . '.' . $request->landscape_banner->extension();

                $requestData['landscape_banner'] = $landscapeBannerName;

                if ($event->landscape_banner != null) {
                    File::delete(public_path('images/landscapeBanner/'. $event->landscape_banner));
                }

                $request->landscape_banner->move(public_path('images/landscapeBanner/'), $landscapeBannerName);
            }

            $this->eventService->updateSubmittedEvent($eventId, $requestData);

            return redirect(route(
                'user.event.detail',
                [Auth::user()->name, $event->type, $event->slug]
            ))
            ->with('success-alert', 'Update Event Success')
            ->with('alert-message', "Sukses merubah data event");
        } catch (\Throwable $th) {
            return back()->with('error-alert', 'Oops')->with('alert-message', $th);
        }
    }
}
