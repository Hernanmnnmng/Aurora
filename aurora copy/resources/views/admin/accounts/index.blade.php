<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounten Overzicht') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('admin.accounts.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Nieuw Account
                    </a>
                </div>

                <table class="min-w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left px-4 py-2">Naam</th>
                            <th class="text-left px-4 py-2">Email</th>
                            <th class="text-left px-4 py-2">Rol</th>
                            <th class="text-left px-4 py-2">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded text-sm 
                                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $user->role === 'medewerker' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $user->role === 'bezoeker' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.accounts.edit', $user) }}" class="text-blue-500 hover:underline">
                                            Bewerken
                                        </a>
                                        <form action="{{ route('admin.accounts.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Weet je zeker dat je dit account wilt verwijderen?')" class="text-red-500 hover:underline">
                                                Verwijderen
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
