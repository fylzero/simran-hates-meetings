<?php

namespace Database\Seeders;

use App\Models\MissedMeeting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = collect([
            ['name' => 'Simran', 'email' => 'simran@example.com'],
            ['name' => 'Test User', 'email' => 'user@example.com'],
        ])->each(function ($user) {
            User::factory()->create($user);
        });

        // Random fake users
        User::factory()->count(6)->create();

        // Add missed meetings for all users
        User::where('email', '!=', 'simran@example.com')->each(function ($user) {
            MissedMeeting::factory()->count(5)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}