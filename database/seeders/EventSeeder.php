<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Event::factory(10)->create();
    }
}