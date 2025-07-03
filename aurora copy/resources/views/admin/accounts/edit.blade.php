<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('admin.accounts.update', $account) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Naam</label>
                        <input type="text" name="name" value="{{ $account->name }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $account->email }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Rol</label>
                        <select name="role" class="w-full border rounded px-3 py-2" required>
                            <option value="bezoeker" {{ $account->role == 'bezoeker' ? 'selected' : '' }}>Bezoeker</option>
                            <option value="medewerker" {{ $account->role == 'medewerker' ? 'selected' : '' }}>Medewerker</option>
                            <option value="admin" {{ $account->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Nieuw wachtwoord (optioneel)</label>
                        <input type="password" name="password" class="w-full border rounded px-3 py-2">
                        <small class="text-gray-500">Laat leeg om het wachtwoord niet te wijzigen.</small>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.accounts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Terug
                        </a>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
