<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bezoeker Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <p class="text-lg font-medium text-gray-900 mb-4">Welkom terug, bezoeker!</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ url('/mijn-tickets') }}" class="block p-6 bg-green-100 hover:bg-green-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Mijn Tickets</h3>
                        <p class="text-sm text-gray-700">Bekijk jouw geboekte tickets.</p>
                    </a>

                    <a href="{{ url('/mijn-reserveringen') }}" class="block p-6 bg-yellow-100 hover:bg-yellow-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Mijn Reserveringen</h3>
                        <p class="text-sm text-gray-700">Beheer je geplande bezoeken.</p>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="block p-6 bg-blue-100 hover:bg-blue-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Profiel</h3>
                        <p class="text-sm text-gray-700">Bekijk of wijzig je profielgegevens.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>