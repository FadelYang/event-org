<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'date' => fake()->date(),
            'ticket_price' => fake()->numberBetween(30000, 150000),
            'quantity' => fake()->numberBetween(500, 2000),
            'is_all_day_pass' => fake()->boolean(),
            'event_id' => Event::factory()
        ];
    }
}
