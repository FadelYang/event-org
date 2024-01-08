<?php

namespace App\Services;

use App\Enum\EventCuratedStatusEnum;
use App\Repositories\EventRepository;

class EventService
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvent()
    {
        return $this->eventRepository->getAllEvent();
    }

    public function getApprovedAndPublishEvent($event)
    {
        return $event->where('is_publish', 1)->where('status', EventCuratedStatusEnum::APPROVED->value);
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

    public function getEventByType($eventType)
    {
        $events = $this->eventRepository->getEventByType($eventType);
        
        return $events;
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

    public function createEvent($data)
    {
        return $this->eventRepository->createEvent($data);
    }

    public function getEventByUserId($userId)
    {
        return $this->eventRepository->getEventByUserID($userId);
    }

    public function getLatestCreatedEventByUser($userId)
    {
        return $this->eventRepository->getLatestCreatedEventByUser($userId);
    }

    public function approveEvent($eventId)
    {
        return $this->eventRepository->approveEvent($eventId);
    }

    public function publishEvent($eventId)
    {
        return $this->eventRepository->publishEvent($eventId);
    }

    public function rejectSubmittedEvent($eventId, $cancelStatement)
    {
        return $this->eventRepository->rejectSubmitedEvent($eventId, $cancelStatement);
    }

    public function updateSubmittedEvent($eventId, $data)
    {
        return $this->eventRepository->updateSubmittedEvent($eventId, $data);
    }
}
