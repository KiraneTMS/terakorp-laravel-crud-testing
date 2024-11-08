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
                    <!-- Greeting -->
                    <p>{{ __("Hello :name!!", ['name' => Auth::user()->name]) }}</p>

                    <!-- Statistics Section -->
                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Total Hospitals -->
                        <div class="p-4 bg-blue-100 rounded-lg shadow-lg">
                            <h3 class="text-lg font-semibold text-blue-700">Total Hospitals</h3>
                            <p class="text-xl text-blue-800">{{ $totalHospitals }}</p>
                        </div>

                        <!-- Total Patients -->
                        <div class="p-4 bg-green-100 rounded-lg shadow-lg">
                            <h3 class="text-lg font-semibold text-green-700">Total Patients</h3>
                            <p class="text-xl text-green-800">{{ $totalPatients }}</p>
                        </div>

                        <!-- Total Users -->
                        <div class="p-4 bg-yellow-100 rounded-lg shadow-lg">
                            <h3 class="text-lg font-semibold text-yellow-700">Total Users</h3>
                            <p class="text-xl text-yellow-800">{{ $totalUsers }}</p>
                        </div>
                    </div>

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
