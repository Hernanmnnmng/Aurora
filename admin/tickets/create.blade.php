<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nieuw Ticket Aanmaken
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.tickets.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="event_name" class="block text-sm font-medium text-gray-700">Evenement Naam</label>
                                <input type="text" name="event_name" id="event_name" value="{{ old('event_name') }}" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                @error('event_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="event_date" class="block text-sm font-medium text-gray-700">Evenement Datum & Tijd</label>
                                <input type="datetime-local" name="event_date" id="event_date" value="{{ old('event_date') }}" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                @error('event_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">Naam Bezoeker</label>
                                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                @error('customer_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700">Email Bezoeker (optioneel)</label>
                                <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('customer_email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700">Account toewijzen (optioneel)</label>
                                <div class="relative">
                                    <input type="text" id="user_search" 
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Zoek op naam of email..." autocomplete="off">
                                    <select name="user_id" id="user_id" 
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <option value="">Selecteer een account</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="seat" class="block text-sm font-medium text-gray-700">Zitplaats (optioneel)</label>
                                <input type="text" name="seat" id="seat" value="{{ old('seat') }}" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('seat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="expires_at" class="block text-sm font-medium text-gray-700">Vervaldatum & Tijd (optioneel)</label>
                                <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="text-xs text-gray-500 mt-1">Laat leeg als het ticket niet vervalt.</p>
                                @error('expires_at')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">Ticket Code (optioneel)</label>
                                <input type="text" name="code" id="code" value="{{ old('code') }}" 
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="text-xs text-gray-500 mt-1">Laat leeg voor automatische code generatie.</p>
                                @error('code')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notities (optioneel)</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                Ticket Aanmaken
                            </button>
                            <a href="{{ route('admin.tickets.index') }}" class="ml-2 px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                                Annuleren
                            </a>
                        </div>
                    </form>                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userSearch = document.getElementById('user_search');
            const userSelect = document.getElementById('user_id');
            const users = Array.from(userSelect.options).slice(1); // Skip the first "Select an account" option
            
            // Hide the select dropdown and just show the search input
            userSelect.style.position = 'absolute';
            userSelect.style.left = '-9999px';
            
            userSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                // Clear current selection if search is empty
                if (searchTerm === '') {
                    userSelect.value = '';
                    return;
                }
                
                // Find matching user
                const matchingUser = users.find(option => 
                    option.textContent.toLowerCase().includes(searchTerm)
                );
                
                if (matchingUser) {
                    userSelect.value = matchingUser.value;
                    
                    // If exact match, update the search field with the full name
                    if (matchingUser.textContent.toLowerCase() === searchTerm) {
                        userSearch.value = matchingUser.textContent;
                    }
                } else {
                    userSelect.value = '';
                }
            });
            
            // When a user is selected, update the search field
            userSelect.addEventListener('change', function() {
                if (this.value) {
                    const selectedOption = this.options[this.selectedIndex];
                    userSearch.value = selectedOption.textContent;
                } else {
                    userSearch.value = '';
                }
            });
            
            // Initialize search field if user is preselected
            if (userSelect.value) {
                const selectedOption = userSelect.options[userSelect.selectedIndex];
                userSearch.value = selectedOption.textContent;
            }
        });
    </script>
    @endpush
</x-app-layout>