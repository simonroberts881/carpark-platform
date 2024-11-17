<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_vehicles_for_user(): void
    {
        $user = User::factory()->has(
            Vehicle::factory(['title' => 'My Vehicle'])
        )->create();

        $response = $this
            ->actingAs($user)
            ->get('/vehicles');

        $response->assertViewHas('vehicles', function ($vehicles) {
            return $vehicles->count() === 1
                && $vehicles->first()->title === 'My Vehicle';
        });
        $response->assertOk();
    }

    public function test_vehicles_blocked_for_guest(): void
    {
        $response = $this->get('/vehicles');

        $response->assertRedirect('/login');
    }



}
