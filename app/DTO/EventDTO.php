<?php

namespace App\DTO;

use DateTime;

class EventDTO
{
    public int $id;
    public string $title;
    public int $user_id;
    public string $slug;
    public string $type;
    public string $description;
    public string $location;
    public bool $is_premium;
    public int $ticket_price;
    public string $portrait_banner;
    public string $landscape_banner;
    public DateTime $start_date;
    public DateTime $end_date;
    public DateTime $start_time;
    public DateTime $end_time;

    public function __construct(
        int $id,
        string $title,
        int $user_id,
        string $slug,
        string $type,
        string $description,
        string $location,
        bool $is_premium,
        int $ticket_price,
        string $portrait_banner,
        string $landscape_banner,
        DateTime $start_date,
        DateTime $end_date,
        DateTime $start_time,
        DateTime $end_time,
    )
    {
        $this->$id = $id;
        $this->title = $title;
        $this->user_id = $user_id;
        $this->slug = $slug;
        $this->type = $type;
        $this->description = $description;
        $this->location = $location;
        $this->is_premium = $is_premium;
        $this->ticket_price = $ticket_price;
        $this->portrait_banner = $portrait_banner;
        $this->landscape_banner = $landscape_banner;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }
}