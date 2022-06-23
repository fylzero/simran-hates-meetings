<?php

namespace Database\Factories;

use App\Models\MissedMeeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissedMeetingFactory extends Factory
{
    protected $model = MissedMeeting::class;

    public function definition(): array
    {
        return [
            // 'id' => 1,
            'user_id' => User::factory(),
            'created_at' => now()->subDays(rand(1, 100)),
            // 'updated_at' => now(),
        ];
    }
}
