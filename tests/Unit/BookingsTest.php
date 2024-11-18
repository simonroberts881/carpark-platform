<?php

namespace Tests\Unit;

use App\Helpers\BookingHelper;
use App\Http\Controllers\BookingController;
use PHPUnit\Framework\TestCase;

class BookingsTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_booking_cost(): void
    {
        $start_date = '2024-11-18';
        $end_date = '2024-11-21';

        $bookingHelper = app(BookingHelper::class);
        $cost = $bookingHelper->calculateBookingCost($start_date, $end_date);

        $this->assertEquals(45, $cost);
    }

}
