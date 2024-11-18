<?php

namespace App\Helpers;

use App\Models\Booking;
use Carbon\Carbon;

class BookingHelper
{

    public int $cost_per_day = 15;
    public int $spaces = 10;

    public function calculateParkingSpacesTaken($startDate, $endDate): int
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

    public function calculateParkingSpacesAvailable($startDate, $endDate): int
    {
        $total_spaces = $this->spaces;
        return $total_spaces - $this->calculateParkingSpacesTaken($startDate, $endDate);
    }

    public function calculateBookingCost($startDate, $endDate): float
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $days = $start->diffInDays($end);
        $per_day_cost = $this->cost_per_day;

        return $days * $per_day_cost;
    }
}
