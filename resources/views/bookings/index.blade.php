<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Your Bookings') }}
                </h2>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <form action="{{ route('bookings.create') }}">
                    <x-primary-button class="ml-2">
                        {{ __('Create New Booking') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->bookings->count() > 0)
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Booking Card -->
                            @foreach(auth()->user()->bookings as $booking)
                                <div class="w-full flex px-4 py-3 border border-gray-500 rounded-md">
                                    <div class="flex-1 flex items-center">
                                        <a href="{{ route('bookings.edit', ['booking' => $booking]) }}">
                                            {{ $booking->vehicle->title }} -
                                            From: {{ $booking->start_date->format('d/m/y') }} - To: {{ $booking->end_date->format('d/m/y') }}
                                            @ £{{ $booking->cost }}
                                        </a>
                                    </div>
                                    <div class="flex-none">
                                        <form action="{{ route('bookings.destroy', ['booking' => $booking]) }}">
                                            @method('DELETE')
                                            <x-danger-button>Delete</x-danger-button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center">
                            <svg class="mx-auto size-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">No bookings</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new booking.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
