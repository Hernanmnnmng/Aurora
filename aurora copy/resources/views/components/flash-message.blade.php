@if(session('success'))
    <div class="py-2 px-3 bg-green-50 mb-6 text-green-800 rounded-md border border-green-300">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="py-2 px-3 bg-red-50 mb-6 text-red-800 rounded-md border border-red-300">
        {{ session('error') }}
    </div>
@endif

@if(session('info'))
    <div class="py-2 px-3 bg-blue-50 mb-6 text-blue-800 rounded-md border border-blue-300">
        {{ session('info') }}
    </div>
@endif
