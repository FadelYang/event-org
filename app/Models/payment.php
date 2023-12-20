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
        'ticket_id',
        'user_id',
        'total_price',
        'item_detail',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_NIK',
        'checkout_link',
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'event_id', 'id');
    }
}
