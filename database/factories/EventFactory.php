<?php

namespace Database\Factories;

use App\Enum\EventTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->name();
        $titleSlug = Str::slug($title);

        return [
            'title' => $title,
            'user_id' => '1',
            'description' => fake()->paragraph(),
            'slug' => $titleSlug,
            'type' => fake()->randomElement(EventTypeEnum::toArray()),
            'location' => fake()->city(),
            'is_premium' => fake()->boolean(),
            'ticket_price' => fake()->numberBetween(0, 25000),
            'potrait_banner' => null,
            'landscape_banner' => null,
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
        ];
    }
}