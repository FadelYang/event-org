<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'type',
        'description',
        'location',
        'is_premium',
        'ticket_price',
        'potrait_banner',
        'landscape_banner',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
    ];

    protected $attributes = [
        'ticket_price' => 0,
        'is_premium' => false
    ];

    public function eventCreator(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
