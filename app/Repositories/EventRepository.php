<?php

namespace App\Repositories;

use App\Enum\EventCuratedStatusEnum;
use App\Enum\EventTypeEnum;
use App\Models\Event;

class EventRepository
{
    public function getAllEvent()
    {
        return Event::with('tickets')->all();
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
        $events = Event::with('tickets')->where('is_premium', true)->orderBy('id', 'desc')->get();

        return $events;
    }

    public function getAllPelatihanEvent()
    {
        $events = Event::with('tickets')->where('type', EventTypeEnum::PELATIHAN->value)->orderBy('id', 'desc')->get();

        return $events;
    }

    public function getAllSeminarEvent()
    {
        $events = Event::with('tickets')->where('type', EventTypeEnum::SEMINAR->value)->orderBy('id', 'desc')->get();

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

    public function approveEvent($eventId)
    {
        return $this->getEventById($eventId)->update([
            'status' => EventCuratedStatusEnum::APPROVED->value
        ]);
    }

    public function publishEvent($eventId)
    {
        return $this->getEventById($eventId)->update([
            'is_publish' => '1'
        ]);
    }

    public function rejectSubmitedEvent($eventId, $cancelStatement)
    {
        return $this->getEventById($eventId)->update([
            'status' => EventCuratedStatusEnum::REJECT->value,
            'cancel_statement' => $cancelStatement,
            'is_publish' => '0'
        ]);
    }

    public function updateSubmittedEvent($eventId, $data)
    {
        return $this->getEventById($eventId)->update($data);
    }
}
