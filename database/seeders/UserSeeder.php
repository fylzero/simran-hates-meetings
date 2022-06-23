<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect([
            ['name' => 'Simran', 'email' => 'simran@example.com'],
            ['name' => 'Test User', 'email' => 'user@example.com'],
        ])->each(function ($user) {
            User::factory()->create($user);
        });
    }
}
