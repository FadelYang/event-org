<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $this->call([
                UserAdminSeeder::class
            ]);
        
            User::factory()
                ->count(8)
                ->has(
                    Event::factory()
                        ->statusAndIsPublishTrue()
                        ->count(3)
                        ->has(
                            Ticket::factory()->count(2)
                        )
                        ->has(
                            Payment::factory()
                                ->whereEventApproved()
                                ->count(1000)
                        )
                )
                ->create(['role' => 'regular']);
        
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
