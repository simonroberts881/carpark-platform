<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('New Vehicle') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('vehicles.store') }}">
                        @csrf

                        <div class="mb-2">
                            <label for="title" class="block text-sm/6 font-medium text-gray-900">Vehicle Title</label>
                            <div class="mt-2">
                                <x-text-input
                                    type="text"
                                    name="title"
                                    id="title"
                                    :value="old('title')"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                                    placeholder="Vehicle Title" />
                            </div>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <x-primary-button>
                            {{ __('Add Vehicle') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
