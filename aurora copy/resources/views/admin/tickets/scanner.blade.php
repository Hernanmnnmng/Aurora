<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket Scanner
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Scan een ticket barcode of voer ticket code in
                    </h2>
                    
                    <!-- Quick links -->
                    <div class="mb-6 flex space-x-4">
                        <a href="{{ route('admin.tickets.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                            <i class="fas fa-list mr-2"></i>Alle Tickets
                        </a>
                        <a href="{{ route('admin.tickets.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            <i class="fas fa-plus mr-2"></i>Nieuw Ticket
                        </a>
                    </div>
                    
                    <div class="mb-6">
                        <form method="POST" action="{{ route('admin.tickets.verify') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="ticket_code" class="block text-sm font-medium text-gray-700">Ticket Code</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="ticket_code" id="ticket_code" autofocus 
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" 
                                        placeholder="Scan of voer ticket code in">
                                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Verifiëren
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Ticket result display -->
                    @if(session('status'))
                        <div class="mt-8 max-w-md mx-auto">
                            <div class="border-2 {{ session('status') === 'success' ? 'border-green-500' : (session('status') === 'used' ? 'border-yellow-500' : 'border-red-500') }} rounded-lg overflow-hidden shadow-lg">
                                <!-- Ticket header -->
                                <div class="{{ session('status') === 'success' ? 'bg-green-500' : (session('status') === 'used' ? 'bg-yellow-500' : 'bg-red-500') }} text-white p-4">
                                    <h3 class="text-xl font-bold">
                                        @if(session('status') === 'success')
                                            Ticket Geldig
                                        @elseif(session('status') === 'used')
                                            Ticket Reeds Gebruikt
                                        @else
                                            Ticket Ongeldig/Verlopen
                                        @endif
                                    </h3>
                                </div>
                                
                                <!-- Ticket body -->
                                <div class="p-4 bg-white">
                                    @if(session('ticket'))                                        <!-- Barcode image -->
                                        <div class="mb-6 flex flex-col items-center justify-center">
                                            <div class="barcode-container w-full border-2 p-4 bg-white mb-2">
                                                <svg id="scanResult" class="w-full h-24"></svg>
                                                <!-- Fallback barcode image if needed -->
                                                @if(session('ticket'))
                                                <img id="fallback-barcode" src="https://bwipjs-api.metafloor.com/?bcid=code128&text={{ urlencode(session('ticket.code')) }}&scale=3&includetext=false&backgroundcolor=ffffff" 
                                                     alt="Barcode" class="mx-auto my-2 w-full h-auto" style="max-height: 100px;">
                                                @endif
                                            </div>
                                            <div class="font-mono text-center mt-2 text-lg">{{ session('ticket.code') }}</div>
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <p class="text-sm text-gray-500">Evenement</p>
                                                <p class="font-semibold">{{ session('ticket.event_name') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Datum</p>
                                                <p class="font-semibold">{{ session('ticket.event_date') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Zitplaats</p>
                                                <p class="font-semibold">{{ session('ticket.seat') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Bezoeker</p>
                                                <p class="font-semibold">{{ session('ticket.customer_name') }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-center items-center h-48">
                                            <p class="text-red-500 font-semibold">{{ session('message') }}</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Ticket footer with status -->
                                <div class="px-4 py-3 {{ session('status') === 'success' ? 'bg-green-100' : (session('status') === 'used' ? 'bg-yellow-100' : 'bg-red-100') }}">
                                    <div class="flex justify-center">
                                        <span class="{{ session('status') === 'success' ? 'text-green-800' : (session('status') === 'used' ? 'text-yellow-800' : 'text-red-800') }} font-bold">
                                            {{ session('message') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Empty ticket display when no scan has been performed -->
                        <div class="mt-8 max-w-md mx-auto">
                            <div class="border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                <div class="bg-gray-300 p-4">
                                    <h3 class="text-xl font-bold text-gray-700">Scan een ticket</h3>
                                </div>
                                <div class="p-4 bg-white">
                                    <div class="mb-6 flex flex-col items-center justify-center">
                                        <svg class="w-full h-24 text-gray-300"></svg>
                                        <div class="font-mono text-center mt-2 text-lg text-gray-400">XXXXXX</div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-400">Evenement</p>
                                            <p class="font-semibold text-gray-400">-</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-400">Datum</p>
                                            <p class="font-semibold text-gray-400">-</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-400">Zitplaats</p>
                                            <p class="font-semibold text-gray-400">-</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-400">Bezoeker</p>
                                            <p class="font-semibold text-gray-400">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-100">
                                    <div class="flex justify-center">
                                        <span class="text-gray-500 font-bold">
                                            Wacht op scan...
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>    @push('scripts')
    <!-- Include JsBarcode library -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <!-- Alternative barcode library -->
    <script src="https://unpkg.com/bwip-js@3.4.0/dist/bwip-js-min.js"></script>
    <script>
        window.onload = function() {
            // Auto focus the input for easier scanning
            document.getElementById('ticket_code').focus();
            
            const scanResult = document.getElementById('scanResult');
            const fallbackBarcode = document.getElementById('fallback-barcode');
            
            if (scanResult && '{{ session("ticket.code") }}') {
                try {
                    // Try JsBarcode first
                    JsBarcode("#scanResult", "{{ session('ticket.code') }}", {
                        format: "CODE128",
                        lineColor: "#000",
                        width: 3,
                        height: 100,
                        displayValue: false,
                        background: "#ffffff",
                        margin: 0
                    });
                    console.log("Barcode generated successfully for: {{ session('ticket.code') }}");
                    
                    // Hide fallback if JsBarcode works
                    if (fallbackBarcode) {
                        fallbackBarcode.style.display = 'none';
                    }
                } catch (e) {
                    console.error("Error generating barcode with JsBarcode:", e);
                    
                    // If JsBarcode fails, try BWIP-JS as alternative
                    try {
                        if (typeof bwipjs !== 'undefined') {
                            let canvas = document.createElement('canvas');
                            bwipjs.toCanvas(canvas, {
                                bcid: 'code128',
                                text: '{{ session("ticket.code") }}',
                                scale: 3,
                                height: 10,
                                includetext: false,
                                textxalign: 'center',
                            });
                            
                            // Add canvas to document
                            const container = document.querySelector('.barcode-container');
                            if (container) {
                                container.innerHTML = '';
                                container.appendChild(canvas);
                                console.log("Barcode generated successfully with BWIP-JS");
                            }
                        }
                    } catch (e2) {
                        console.error("Error generating barcode with BWIP-JS:", e2);
                        // Keep the fallback image visible if both methods fail
                        if (scanResult) scanResult.style.display = 'none';
                    }
                }
            }
        };
    </script>
    @endpush
</x-app-layout>