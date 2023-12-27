<?php

namespace App\Repositories;

use App\Enum\EventTypeEnum;
use App\Models\Event;

class EventRepository
{
    public function getAllEvent()
    {
        return Event::all();
    }

    public function getEventById($eventId)
    {
        $event = Event::find($eventId);

        return $event;
    }

    public function getEventByType($eventType)
    {
        $events = Event::where('type', $eventType)->get();

        return $events;
    }

    public function getEventBySlug($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->first();

        return $event;
    }

    public function getEventByTypeAndSlug($eventType, $eventSlug)
    {
        $events = Event::where('type', $eventType)->get();
        $event = null;

        foreach ($events as $item) {
            if ($item->slug == $eventSlug) {
                $event = $item;
            }
        }

        return $event;
    }

    public function getAllPilihanEvent()
    {
        $events = Event::where('is_premium', true)->get();

        return $events;
    }

    public function getAllPelatihanEvent()
    {
        $events = Event::where('type', EventTypeEnum::PELATIHAN->value)->get();

        return $events;
    }

    public function getAllSeminarEvent()
    {
        $events = Event::where('type', EventTypeEnum::SEMINAR->value)->get();

        return $events;
    }

    public function createEvent($data)
    {
        return Event::create($data);
    }
}
