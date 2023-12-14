<?php

namespace App\Http\Controllers;

use App\DTO\EventDTO;
use App\Services\EventService;

class EventController
{
    protected $eventService;

    public function __construct(EventService $eventService) {
        $this->eventService = $eventService;
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

        return view('pages.event.detail.index', [
            'event' => $event
        ]);
    }

    public function getEventsByTypePage($eventType)
    {
        $events = $this->eventService->getEventByType($eventType);

        return view('pages.event.type', [
            'events' => $events
        ]);
    }
}
