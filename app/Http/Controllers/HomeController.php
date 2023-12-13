<?php

namespace App\Http\Controllers;

use App\Services\EventService;

class HomeController
{
    protected $eventService;

    public function __construct(EventService $eventService) {
        $this->eventService = $eventService;
    }

    public function getHomePage()
    {
        $pelatihanEvents = $this->eventService->getAllPelatihanEvent();
        $seminarEvents = $this->eventService->getAllSeminarEvent();
        $pilihanEvents = $this->eventService->getAllPilihanEvent();

        return view('pages.home.home', [
            'pelatihanEvents' => $pelatihanEvents,
            'seminarEvents' => $seminarEvents,
            'pilihanEvents' => $pilihanEvents,
        ]);
    }
}
