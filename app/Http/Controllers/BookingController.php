<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Helpers\BookingHelper;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use Carbon\Carbon;

#[AllowDynamicProperties]
class BookingController extends Controller
{

    public function index()
    {
        return view('bookings.index');
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(StoreBookingRequest $request)
    {
        $bookingHelper = app(BookingHelper::class);

        Booking::query()->create(
            array_merge(
                $request->validate([
                    'vehicle_id' => 'required|exists:vehicles,id',
                    'start_date' => 'required|date|after:today',
                    'end_date' => 'required|date|after:start_date',
                ]),
                [
                    'user_id' => auth()->user()->id,
                    'cost' => (float) $bookingHelper->calculateBookingCost($request['start_date'], $request['end_date']),
                ]
            )
        );

        return redirect()->route('bookings.home');
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $booking->update($request->only('vehicle_id','start_date','end_date'));

        return redirect()->route('bookings.home');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.home');
    }

    public function totalBookings()
    {
        $start_date = request('start_date');
        $end_date = request('end_date');
        $total_bookings = (new BookingHelper())->calculateParkingSpacesTaken(
            $start_date,
            $end_date
        );

        return response()->json([
            'spaces_left' => config('carpark.spaces') - $total_bookings,
            'total_bookings' => $total_bookings
        ]);
    }

}
