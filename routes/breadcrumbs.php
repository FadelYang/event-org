<?php

use App\Http\Controllers\EventController;
use App\Models\Ticket;
use App\Repositories\EventRepository;
use App\Repositories\TicketRepository;
use App\Services\EventService;
use App\Services\TicketService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// home > event
Breadcrumbs::for('event', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Event', route('event.get'));
});

// home > event > event_type > event_name
Breadcrumbs::for('detailEvent', function (BreadcrumbTrail $trail, $event) {
    // I dont know why I should do it, there no another way to use the controller without create new object of every layer?
    $eventRepository = new EventRepository();
    $eventService = new EventService($eventRepository);

    $ticketRepository = new TicketRepository();
    $ticketService = new TicketService($ticketRepository);

    $eventController = new EventController($eventService, $ticketService);

    $eventDetail = $eventController->getEventDetail($event[0], $event[1]);

    $trail->parent('event');
    $trail->push($eventDetail->type, route('event.get.by-type', [$eventDetail->type]));
    $trail->push($eventDetail->title, route('event.detail', [$eventDetail->type, $eventDetail->slug]));
});

// home > event > event_type > event_name > checkout
Breadcrumbs::for('checkoutTicket', function (BreadcrumbTrail $trail, $event) {
    // I dont know why I should do it, there no another way to use the controller without create new object of every layer?
    $eventRepository = new EventRepository();
    $eventService = new EventService($eventRepository);

    $ticketRepository = new TicketRepository();
    $ticketService = new TicketService($ticketRepository);

    $eventController = new EventController($eventService, $ticketService);

    $eventDetail = $eventController->getEventDetail($event[0], $event[1]);

    $trail->parent('event');
    $trail->push($eventDetail->type, route('event.get.by-type', [$eventDetail->type]));
    $trail->push($eventDetail->title, route('event.detail', [$eventDetail->type, $eventDetail->slug]));
    $trail->push('Checkout');
});

// home > create event
Breadcrumbs::for('createEvent', function(BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Event', route('event.create'));
});

// home > create event > Event
Breadcrumbs::for('createBasicEvent', function(BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Event', route('event.create'));
    $trail->push('Basic', route('event.create.form-basic'));
});