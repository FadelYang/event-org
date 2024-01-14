<?php

namespace Database\Factories;

use App\Enum\EventCuratedStatusEnum;
use App\Enum\PaymentStatusEnum;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => rand(),
            'snap_token' => rand(),
            'status' => fake()->randomElement(PaymentStatusEnum::toArray()),
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'event_name' => rand(),
            'item_detail' => '[{"ticketId":1,"ticketName":"Regular Ticket Day 1","ticketPrice":"50000","ticketDate":"2024-01-12","totalSelectedTickets":"1"}]',
            'customer_detail' => '[{"customerName":"Fadela Numah Kadenza","customerEmail":"fadelanumah@gmail.com","customerPhone":"085156305786","customerAddress":"jl. lmao","customerNIK":"123123"}]',
            'total_price' => 75000,
        ];
    }

    public function whereEventApproved()
    {
        return $this->state(function () {
            return [
                'status' => PaymentStatusEnum::SUCCESS->value
            ];
        });
    }
}
