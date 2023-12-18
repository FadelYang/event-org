<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'ticket_price',
        'event_id',
    ];

    protected $attributes = [
        'type' => 'regular'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'event_id', 'id');
    }
}
