<?php

namespace App\Http\Controllers;

use App\Enum\EventCuratedStatusEnum;
use App\Services\EventService;
use App\Services\TicketService;

class HomeController
{
    protected $eventService;
    protected $ticketService;

    public function __construct(EventService $eventService, TicketService $ticketService)
    {
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
    }

    public function getHomePage()
    {
        $pelatihanEvents = $this->eventService->getApprovedAndPublishEvent($this->eventService->getAllPelatihanEvent());
        $seminarEvents = $this->eventService->getApprovedAndPublishEvent($this->eventService->getAllSeminarEvent());
        $pilihanEvents = $this->eventService->getApprovedAndPublishEvent($this->eventService->getAllPilihanEvent());

        return view('pages.home.home', [
            'pelatihanEvents' => $pelatihanEvents,
            'seminarEvents' => $seminarEvents,
            'pilihanEvents' => $pilihanEvents,
        ]);
    }
}
