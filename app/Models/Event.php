<?php

namespace App\Models;

use App\Enum\EventCuratedStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'organizer_name',
        'PIC_email',
        'PIC_phone',
        'organizer_name',
        'cancel_statement',
        'slug',
        'type',
        'status',
        'description',
        'location',
        'is_premium',
        'is_online',
        'is_publish',
        'is_finish',
        'potrait_banner',
        'total_day',
        'landscape_banner',
        'start_date',
        'end_date'
    ];

    protected $attributes = [
        'is_premium' => true,
        'is_finish' => false,
        'is_publish' => false,
        'status' => EventCuratedStatusEnum::PENDING->value
    ];

    public function eventCreator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'event_id', 'id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Payment::class, 'event_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'event_id', 'id');
    }
}
