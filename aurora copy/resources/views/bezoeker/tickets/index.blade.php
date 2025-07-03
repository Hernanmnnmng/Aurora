<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mijn Tickets
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Mijn Tickets Overzicht
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evenement</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Datum</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zitplaats</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets as $ticket)
                                    <tr>
                                        <td class="py-3 px-4 border-b border-gray-200 font-mono">{{ $ticket->code }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $ticket->event_name }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $ticket->event_date->format('d-m-Y H:i') }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $ticket->seat ?? 'Geen zitplaats' }}</td>
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
                                        <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                            <a href="{{ route('bezoeker.tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900 mr-2">Bekijken</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-3 px-4 border-b border-gray-200 text-center text-gray-500">
                                            Je hebt nog geen tickets
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
