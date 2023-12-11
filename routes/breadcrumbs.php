<?php

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
   $trail->parent('event');
   $trail->push($event[0], route('event.get.by-type', [$event[0]])); 
   $trail->push($event[1], route('event.detail', [$event[0], $event[1]])); 
});
