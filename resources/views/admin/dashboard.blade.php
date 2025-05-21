<x-app-layout>
    @include('partials.navbar')

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <!-- Account Overview -->
                <a href="{{ route('admin.accounts') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Accounten Overzicht</h3>
                    <p class="text-sm text-gray-600 mt-2">Bekijk en beheer gebruikersaccounts.</p>
                </a>

                <!-- Medewerkers Overview -->
                <a href="{{ route('admin.medewerkers') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Medewerkers Overzicht</h3>
                    <p class="text-sm text-gray-600 mt-2">Bekijk en wijs medewerkersrollen toe.</p>
                </a>

                <!-- Tickets Management -->
                <a href="{{ route('admin.tickets') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Tickets</h3>
                    <p class="text-sm text-gray-600 mt-2">Bekijk en beheer verkochte tickets.</p>
                </a>

                <!-- Reservations Management -->
                <a href="{{ route('admin.reservations') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Reserveringen</h3>
                    <p class="text-sm text-gray-600 mt-2">Bekijk en verwerk reserveringen.</p>
                </a>

                <!-- Performances Management -->
                <a href="{{ route('admin.performances') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Voorstellingen</h3>
                    <p class="text-sm text-gray-600 mt-2">Voeg voorstellingen toe of pas deze aan.</p>
                </a>

                <!-- Contact Requests -->
                <a href="{{ route('admin.contacts') }}" class="bg-white shadow hover:shadow-md transition rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Contactaanvragen</h3>
                    <p class="text-sm text-gray-600 mt-2">Beantwoord klantvragen en berichten.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>