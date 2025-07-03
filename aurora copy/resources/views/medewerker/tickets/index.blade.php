<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tickets
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Tickets Overzicht
                        </h2>

                        <!-- Scanner link -->
                        <a href="{{ route('medewerker.tickets.scanner') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 10a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM9 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1V4zm2 2V5h1v1h-1zM9 10a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-3zm2 2v-1h1v1h-1zM16 3a1 1 0 011 1v7.59l-2-2L13.5 11l-2-2-3 3-3-3-1.59 1.59-2-2V4a1 1 0 011-1h7zm0 15H5a1 1 0 01-1-1v-3.59l3-3 3 3 2-2 1.5 1.5 2-2 1.59 1.59.91.91V17a1 1 0 01-1 1z" clip-rule="evenodd"/>
                            </svg>
                            Ticket Scanner
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evenement</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Datum</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bezoeker</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets as $ticket)
                                    <tr>
                                        <td class="py-3 px-4 border-b border-gray-200 font-mono">{{ $ticket->code }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $ticket->event_name }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $ticket->event_date->format('d-m-Y H:i') }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $ticket->customer_name }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            @if($ticket->used)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Gebruikt
                                                </span>
                                            @elseif($ticket->isExpired())
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Verlopen
                                                </span>
                                            @elseif($ticket->cancelled)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Geannuleerd
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Geldig
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-3 px-4 border-b border-gray-200 text-center text-gray-500">
                                            Geen tickets gevonden
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
