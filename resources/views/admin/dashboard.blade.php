<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <!-- Account Overview -->
                <a href="{{ route('admin.accounts.index') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Accounten Overzicht</h3>
                    <p class="text-sm text-gray-600 mt-2">Bekijk en beheer gebruikersaccounts.</p>
                </a>

                <!-- Medewerkers Overview -->
                <a href="{{ route('admin.medewerkers.index') }}" class="bg-green-100 hover:bg-green-200 shadow transition rounded-lg p-6 border border-green-200">
                    <h3 class="text-lg font-semibold text-gray-900">Medewerkers Overzicht</h3>
                    <p class="text-sm text-gray-700 mt-2">Bekijk en wijs medewerkersrollen toe.</p>
                </a>

                <!-- Tickets Management -->
                <a href="{{ route('admin.tickets.index') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Tickets</h3>
                    <p class="text-sm text-gray-600 mt-2">Bekijk en beheer alle tickets.</p>
                </a>
                
                <!-- Ticket Scanner -->
                <a href="{{ route('admin.tickets.scanner') }}" class="bg-indigo-100 hover:bg-indigo-200 shadow transition rounded-lg p-6 border border-indigo-200">
                    <h3 class="text-lg font-semibold text-gray-900">Ticket Scanner</h3>
                    <p class="text-sm text-gray-600 mt-2">Scan en verifieer tickets van bezoekers.</p>
                </a>

                <!-- Reservations Management -->
                <a href="{{ route('admin.reservations.index') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Reserveringen</h3>
                    <p class="text-sm text-gray-600 mt-2">Bekijk en verwerk reserveringen.</p>
                </a>

                <!-- Performances Management -->
                <a href="{{ route('admin.performances.index') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Voorstellingen</h3>
                    <p class="text-sm text-gray-600 mt-2">Voeg voorstellingen toe of pas deze aan.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>