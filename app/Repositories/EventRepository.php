<?php

namespace App\Repositories;

use App\Enum\EventTypeEnum;
use App\Models\Event;

class EventRepository
{
    public function getEventById($eventId)
    {
        $event = Event::find($eventId);

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
}