<?php

namespace Database\Seeders;

use App\Models\MissedMeeting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MissedMeetingSeeder extends Seeder
{
    public function run(): void
    {
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
