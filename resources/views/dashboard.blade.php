<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <form action="{{ route('vehicles.create') }}">
                    <x-primary-button>
                        {{ __('Add New Vehicle') }}
                    </x-primary-button>
                </form>
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
            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome, back!") }} {{ Auth::user()->name }}
                </div>
            </div>
            @if(auth()->user()->bookings->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Your up coming bookings") }}
                    {{ auth()->user()->bookings->count() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
