<?php

use App\Http\Controllers\EventController;
use App\Repositories\EventRepository;
use App\Services\EventService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// home > event
Breadcrumbs::for('event', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('event', route('event.get'));
});

// home > event > event_type > event_name
Breadcrumbs::for('detailEvent', function (BreadcrumbTrail $trail, $event) {
    $eventRepository = new EventRepository();
    $eventService = new EventService($eventRepository);
    $eventController = new EventController($eventService);

    $eventDetail = $eventController->getEventDetail($event[0], $event[1]);

    $trail->parent('event');
    $trail->push($eventDetail->type, route('event.get.by-type', [$eventDetail->type])); 
    $trail->push($eventDetail->title, route('event.detail', [$eventDetail->type, $eventDetail->slug])); 
});
