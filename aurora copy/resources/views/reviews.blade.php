<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Reviews
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Review Form -->
        <div class="bg-white shadow-md rounded p-6 mb-8">
            <h3 class="text-lg font-bold mb-4">Laat een review achter</h3>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="block font-medium text-sm text-gray-700">Beoordeling (1-5)</label>
                    <select name="rating" id="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} ster{{ $i > 1 ? 'ren' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-4">
                    <label for="content" class="block font-medium text-sm text-gray-700">Jouw review</label>
                    <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    Verzenden
                </button>
            </form>
        </div>

        <!-- Existing Reviews -->
        <div class="bg-white shadow-md rounded p-6">
            <h3 class="text-lg font-bold mb-4">Alle reviews</h3>
            @forelse ($reviews as $review)
                <div class="border-b border-gray-200 mb-4 pb-4">
                    <p class="text-sm text-gray-600">
                        Gepost door <strong>{{ $review->gebruiker->name }}</strong> op {{ $review->created_at->format('d-m-Y') }}
                    </p>
                    <p class="text-yellow-500 mb-2">
                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                    </p>
                    <p class="text-gray-800">{{ $review->content }}</p>
                </div>
            @empty
                <p class="text-gray-500">Er zijn nog geen reviews.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>