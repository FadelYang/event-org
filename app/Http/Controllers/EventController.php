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

    public function getEventDetailPage()
    {
        $event = $this->eventService->getEventById(1);

        return view('pages.event.detail', [
            'event' => $event
        ]);
    }
}
