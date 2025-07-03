@php
    $isMedewerker = auth()->user()->role === 'medewerker';
    $prefix = $isMedewerker ? 'medewerker.accounten' : 'admin.accounts';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounten Overzicht') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Naam</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Rol</th>
                            <th class="text-left">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td class="space-x-2">
                                    @if(!$isMedewerker || $user->role === 'bezoeker')
                                        <a href="{{ route($prefix . '.edit', $user) }}" class="text-blue-500 hover:underline">Bewerken</a>
                                        <form action="{{ route($prefix . '.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Weet je zeker dat je dit account wilt verwijderen?')" class="text-red-500 hover:underline">
                                                Verwijderen
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="{{ route($prefix . '.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Nieuw Account</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>