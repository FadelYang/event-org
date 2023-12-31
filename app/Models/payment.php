<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'snap_token',
        'status',
        'price',
        'user_id',
        'event_id',
        'event_name',
        'total_price',
        'item_detail',
        'customer_detail',
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'event_id', 'id');
    }
}
