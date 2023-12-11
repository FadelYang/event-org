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

    public function getEventDetailPage($eventSlug)
    {
        $event = $this->eventService->getEventBySlug($eventSlug);

        return view('pages.event.detail', [
            'event' => $event
        ]);
    }
}
