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
            'orginazer_name' => $title,
            'orginazer_name' => $title,
            'PIC_email' => fake()->email(),
            'PIC_phone_number' => fake()->phoneNumber(),
            'user_id' => '1',
            // 'organizer' => $title,
            'description' => fake()->paragraph(),
            'slug' => $titleSlug,
            'type' => fake()->randomElement(EventTypeEnum::toArray()),
            'location' => fake()->city(),
            'is_premium' => fake()->boolean(),
            'is_publish' => fake()->boolean(),
            'is_online' => fake()->boolean(),
            'potrait_banner' => null,
            'landscape_banner' => null,
            'start_date' => fake()->date(),
            'total_day' => 3,
        ];
    }
}
