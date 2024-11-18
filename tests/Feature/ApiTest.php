<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Database\Factories\BookingFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    #[NoReturn]
    public function test_calculate_bookings_between_dates(): void
    {
        $user = User::factory()->create();

        $booking = Booking::factory(2)
            ->for(Vehicle::factory(['title' => 'My Vehicle', 'user_id' => $user->id]), 'vehicle')
            ->create([
                'user_id' => $user->id,
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-05',
            ]);

        $response = $this->post('/api/bookings?start_date=2024-11-01&end_date=2024-12-01');
        $response->assertJsonFragment(['total_bookings' => 2]);

    }


}
