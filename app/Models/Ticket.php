<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'event_id',
    ];

    protected $attributes = [
        'type' => 'regular'
    ];

    public function event(): HasOne
    {
        return $this->hasOne(Event::class, 'event_id', 'id');
    }
}
