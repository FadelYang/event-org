<?php

namespace App\Services;

use App\Repositories\EventRepository;

class EventService
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    
    public function getEventById($eventId)
    {
        $event = $this->eventRepository->getEventById($eventId);
        
        return $event;
    }

    public function getEventBySlug($eventSlug)
    {
        $event = $this->eventRepository->getEventBySlug($eventSlug);
        
        return $event;
    }

    public function getEventByTypeAndSlug($eventType, $eventSlug)
    {
        $event = $this->eventRepository->getEventByTypeAndSlug($eventType, $eventSlug);

        return $event;
    }

    public function getAllPilihanEvent()
    {
        $events = $this->eventRepository->getAllPilihanEvent();

        return $events; 
    }

    public function getAllPelatihanEvent()
    {
        $events = $this->eventRepository->getAllPelatihanEvent();

        return $events;
    }

    public function getAllSeminarEvent()
    {
        $events = $this->eventRepository->getAllSeminarEvent();

        return $events;
    }
}
