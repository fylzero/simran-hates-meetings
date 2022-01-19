<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\MissedMeeting;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissedMeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MissedMeeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id' => 1,
            'user_id' => User::factory(),
            'created_at' => now()->subDays(rand(1, 100)),
            // 'updated_at' => now(),
        ];
    }
}
