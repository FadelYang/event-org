<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
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
        'potrait_banner',
        'landscape_banner',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
    ];

    protected $attributes = [
        'is_premium' => false
    ];

    public function eventCreator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'event_id', 'id');
    }
}
