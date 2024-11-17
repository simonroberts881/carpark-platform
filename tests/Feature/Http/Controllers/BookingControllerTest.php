<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_show_bookings_for_user(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/bookings');

        $response->assertOk();
    }

    public function test_bookings_for_guest(): void
    {
        $response = $this->get('/bookings');

        $response->assertRedirect('/login');
    }
}
