<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket Details
        </h2>
    </x-slot>    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Ticket: {{ $ticket->code }}
                        </h2>
                        <div>
                            <a href="{{ route('bezoeker.tickets.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                                Terug
                            </a>
                        </div>
                    </div>

                    <!-- Ticket display -->
                    <div class="max-w-lg mx-auto border-2 rounded-lg overflow-hidden {{ $ticket->isValid() ? 'border-green-500' : ($ticket->used ? 'border-yellow-500' : 'border-red-500') }}">
                        <!-- Ticket header -->
                        <div class="{{ $ticket->isValid() ? 'bg-green-500' : ($ticket->used ? 'bg-yellow-500' : 'bg-red-500') }} text-white p-4">
                            <h3 class="text-xl font-bold">
                                @if($ticket->isValid())
                                    Ticket Geldig
                                @elseif($ticket->used)
                                    Ticket Gebruikt
                                @elseif($ticket->cancelled)
                                    Ticket Geannuleerd
                                @else
                                    Ticket Verlopen
                                @endif
                            </h3>
                        </div>
                        
                        <!-- Ticket body -->
                        <div class="p-6 bg-white">                            <!-- Barcode image -->
                            <div class="mb-6 flex flex-col items-center justify-center">
                                <!-- Barcode container -->
                                <div class="barcode-container w-full border-2 p-4 bg-white mb-2">
                                    <svg id="barcode"></svg>
                                    <!-- Fallback barcode image via externe API -->
                                    <img id="fallback-barcode" src="https://bwipjs-api.metafloor.com/?bcid=code128&text={{ urlencode($ticket->code) }}&scale=3&includetext=false&backgroundcolor=ffffff" 
                                         alt="Barcode" class="mx-auto my-2 w-full h-auto" style="max-height: 100px;">
                                </div>
                                <div class="font-mono text-center mt-2 text-lg">{{ $ticket->code }}</div>
                                <div class="text-center mt-1 text-sm text-gray-600">Toegangscode: scan bij ingang</div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Evenement</p>
                                    <p class="font-semibold">{{ $ticket->event_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Datum</p>
                                    <p class="font-semibold">{{ $ticket->event_date->format('d-m-Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Zitplaats</p>
                                    <p class="font-semibold">{{ $ticket->seat ?? 'Geen zitplaats' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Bezoeker</p>
                                    <p class="font-semibold">{{ $ticket->customer_name }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ticket footer -->
                        <div class="px-4 py-3 {{ $ticket->isValid() ? 'bg-green-100' : ($ticket->used ? 'bg-yellow-100' : 'bg-red-100') }}">
                            <div class="flex justify-between">
                                <span class="text-sm">Ticket ID: {{ $ticket->id }}</span>
                                <span class="text-sm">
                                    @if($ticket->used)
                                        Gebruikt op: {{ $ticket->used_at->format('d-m-Y H:i') }}
                                    @elseif($ticket->expires_at)
                                        Geldig tot: {{ $ticket->expires_at->format('d-m-Y H:i') }}
                                    @else
                                        Geen vervaldatum
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Print button -->
                    <div class="mt-6 text-center">
                        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Print Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>    @push('scripts')
    <!-- Include JsBarcode library -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <!-- Alternatieve barcode bibliotheek -->
    <script src="https://unpkg.com/bwip-js@3.4.0/dist/bwip-js-min.js"></script>    <script>
        // Wacht tot het document volledig geladen is
        window.onload = function() {
            // Direct genereren zonder DOMContentLoaded (soms kan dit een issue zijn)
            setTimeout(function() {
                try {
                    // Probeer eerst met JsBarcode
                    JsBarcode("#barcode", "{{ $ticket->code }}", {
                        format: "CODE128",
                        width: 3,
                        height: 100,
                        displayValue: false,
                        margin: 0
                    });
                    console.log("Barcode succesvol gegenereerd voor: {{ $ticket->code }}");
                    // Als JsBarcode slaagt, verberg de fallback image
                    document.getElementById('fallback-barcode').style.display = 'none';
                } catch (e) {
                    console.error("Fout bij genereren barcode met JsBarcode:", e);
                    
                    // Als JsBarcode faalt, probeer BWIP-JS als alternatief
                    try {
                        let canvas = document.createElement('canvas');
                        bwipjs.toCanvas(canvas, {
                            bcid: 'code128',
                            text: '{{ $ticket->code }}',
                            scale: 3,
                            height: 10,
                            includetext: false,
                            textxalign: 'center',
                        });
                        
                        // Voeg de canvas toe aan het document
                        document.querySelector('.barcode-container').innerHTML = '';
                        document.querySelector('.barcode-container').appendChild(canvas);
                        console.log("Barcode succesvol gegenereerd met BWIP-JS");
                    } catch (e2) {
                        console.error("Fout bij genereren barcode met BWIP-JS:", e2);
                        // Als beide barcode generatiemethoden falen, laat de fallback image staan
                        document.getElementById('barcode').style.display = 'none';
                    }
                }
            }, 100); // Kleine vertraging om ervoor te zorgen dat alles geladen is
        };
    </script>
    @endpush
</x-app-layout>
