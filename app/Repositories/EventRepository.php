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
        $events = Event::where('is_premium', true)->orderBy('id', 'desc')->get();

        return $events;
    }

    public function getAllPelatihanEvent()
    {
        $events = Event::where('type', EventTypeEnum::PELATIHAN->value)->orderBy('id', 'desc')->get();

        return $events;
    }

    public function getAllSeminarEvent()
    {
        $events = Event::where('type', EventTypeEnum::SEMINAR->value)->orderBy('id', 'desc')->get();

        return $events;
    }

    public function createEvent($data)
    {
        return Event::create($data);
    }

    public function getEventByUserId($userId)
    {
        return Event::where('user_id', $userId)->get();
    }

    public function getLatestCreatedEventByUser($userId)
    {
        return Event::where('user_id', $userId)->orderBy('id', 'desc')->first();
    }
}
