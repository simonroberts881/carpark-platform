<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('New Booking') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <div class="grid grid-cols-3 gap-2">
                            <div class="mb-2">
                                <label for="vehicle_id" class="block text-sm/6 font-medium text-gray-900">Vehicle for this Booking</label>
                                <div class="mt-2">
                                    <select
                                        name="vehicle_id"
                                        id="vehicle_id"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                                    >
                                        <option value="">Select Vehicle</option>
                                        @foreach (auth()->user()->vehicles as $vehicle)
                                            <option
                                                {{ (old("vehicle_id") == $vehicle->id ? "selected":"") }}
                                                value="{{ $vehicle->id }}">{{ $vehicle->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" />
                            </div>

                            <div class="mb-2">
                                <label for="start_date" class="block text-sm/6 font-medium text-gray-900">Start Date</label>
                                <div class="mt-2">
                                    <x-text-input
                                        type="date"
                                        name="start_date"
                                        id="start_date"
                                        :value="old('start_date')"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                                </div>
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>
                            <div class="mb-2">
                                <label for="start_date" class="block text-sm/6 font-medium text-gray-900">End Date</label>
                                <div class="mt-2">
                                    <x-text-input
                                        type="date"
                                        name="end_date"
                                        id="end_date"
                                        :value="old('end_date')"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                                </div>
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                            </div>
                        </div>

                        <x-primary-button>
                            {{ __('Make a Booking') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
