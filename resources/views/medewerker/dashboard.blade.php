{{-- resources/views/medewerker/dashboard.blade.php --}}
<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Medewerker Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <p class="text-lg font-medium text-gray-900 mb-4">Welkom terug, medewerker!</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ route('medewerker.accounten.index') }}" class="block p-6 bg-blue-100 hover:bg-blue-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Accounten overzicht</h3>
                        <p class="text-sm text-gray-700">Bekijk en beheer gebruikersaccounts.</p>
                    </a>

                    <a href="{{ url('/tickets') }}" class="block p-6 bg-green-100 hover:bg-green-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Tickets</h3>
                        <p class="text-sm text-gray-700">Beheer tickets van klanten.</p>
                    </a>

                    <a href="{{ url('/reserveringen') }}" class="block p-6 bg-yellow-100 hover:bg-yellow-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Reserveringen</h3>
                        <p class="text-sm text-gray-700">Bekijk geplande reserveringen.</p>
                    </a>

                    <a href="{{ url('/voorstellingen') }}" class="block p-6 bg-purple-100 hover:bg-purple-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Voorstellingen</h3>
                        <p class="text-sm text-gray-700">Overzicht van alle voorstellingen.</p>
                    </a>

                    <a href="{{ url('/contactaanvragen') }}" class="block p-6 bg-red-100 hover:bg-red-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Contactaanvragen</h3>
                        <p class="text-sm text-gray-700">Bekijk binnengekomen berichten.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>