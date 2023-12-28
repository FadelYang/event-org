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
        'date',
        'quantity',
        'is_all_day_pass',
        'event_id',
        'ticket_price',
        'event_id',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'event_id', 'id');
    }
}
