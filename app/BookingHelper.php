<?php

namespace App;

use App\Models\Booking;
use Carbon\Carbon;

class BookingHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function calculateParkingSpacesTaken($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $bookings = Booking::where(function($query) use ($start, $end) {
            $query->whereBetween('start_date', [$start, $end])
                ->orWhereBetween('end_date', [$start, $end])
                ->orWhere(function($query) use ($start, $end) {
                    $query->where('start_date', '<=', $start)
                        ->where('end_date', '>=', $end);
                });
        })->get();

        return $bookings->count();
    }
}
