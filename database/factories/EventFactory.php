<?php

namespace Database\Factories;

use App\Enum\EventCuratedStatusEnum;
use App\Enum\EventTypeEnum;
use App\Models\Event;
use App\Models\User;
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
            'organizer_name' => $title,
            'PIC_email' => fake()->email(),
            'PIC_phone' => fake()->phoneNumber(),
            'user_id' => User::factory(),
            // 'organizer' => $title,
            'description' => fake()->paragraph(),
            'slug' => $titleSlug,
            'type' => fake()->randomElement(EventTypeEnum::toArray()),
            'status' => fake()->randomElement(EventCuratedStatusEnum::toArray()),
            'location' => fake()->city(),
            'is_premium' => fake()->boolean(),
            'is_publish' => fake()->boolean(),
            'is_online' => fake()->boolean(),
            'potrait_banner' => null,
            'landscape_banner' => null,
            'start_date' => fake()->dateTimeBetween(date('Y-m-d'), '+2 weeks'),
            'total_day' => 3,
        ];
    }

    public function statusAndIsPublishTrue()
    {
        return $this->state(function () {
            return [
                'status' => EventCuratedStatusEnum::APPROVED,
                'is_publish' => true,
            ];
        });
    }
}
