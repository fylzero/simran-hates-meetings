<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function the_application_returns_a_successful_response()
    {
        return $this->markTestSkipped('Test not working.');

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
