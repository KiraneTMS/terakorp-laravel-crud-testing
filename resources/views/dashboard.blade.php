<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Display the user's name -->
                    <p>{{ __("You're logged in as :name", ['name' => Auth::user()->name]) }}</p>

                    <!-- Buttons for Hospital and Patients page -->
                    <div class="mt-4">
                        <a href="{{ route('hospitals.index') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Go to Hospital
                        </a>
                        <a href="{{ route('patients.index') }}" class="px-4 py-2 ml-4 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            Go to Patients
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
