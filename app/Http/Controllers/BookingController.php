<?php

namespace App\Http\Controllers;

use App\BookingHelper;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;

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
        Booking::query()->create(
            array_merge(
                $request->validate([
                    'vehicle_id' => 'required|exists:vehicles,id',
                    'start_date' => 'required|date|after:today',
                    'end_date' => 'required|date|after:start_date',
                ]),
                ['user_id' => auth()->user()->id]
            )
        );

        return redirect()->route('bookings.home');
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $booking->update($request->only('title'));

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

        return response()->json(['total_bookings' => $total_bookings]);
    }
}
