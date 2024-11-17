<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function index()
    {
        $vehicles = auth()->user()->vehicles;

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(StoreVehicleRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        auth()->user()->vehicles()->create($request->only('title'));

        return redirect()->route('vehicles.home');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $vehicle->update($request->only('title'));

        return redirect()->route('vehicles.home');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.home');
    }
}
