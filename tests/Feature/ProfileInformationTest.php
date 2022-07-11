<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function profile_information_can_be_updated()
    {
        $user = User::factory()->create([
            'email' => 'testuser@'.explode(',', config('app.allowed_domains'))[0],
        ]);

        $this->actingAs($user);

        $email = 'somebody@'.explode(',', config('app.allowed_domains'))[0];

        $response = $this->put('/user/profile-information', [
            'name' => 'Test Name',
            'email' => $email,
            'timezone' => 'America/Chicago',
        ]);

        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals($email, $user->fresh()->email);
    }
}
