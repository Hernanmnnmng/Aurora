<nav class="bg-white border-b border-gray-200 shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex-shrink-0 flex items-center space-x-2">
                <i class="fas fa-theater-masks text-2xl text-purple-500"></i>
                <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600 hover:text-indigo-800 transition duration-200">
                    Aurora
                </a>
            </div>

            <div class="flex space-x-4 items-center">
                <!-- Always visible links -->
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Home</a>
                <a href="{{ url('/about') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">About</a>
                <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Contact</a>
                <a href="{{ url('/voorstellingen') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Voorstellingen</a>

                @auth
                    @php $role = auth()->user()->role; @endphp

                    <!-- Role-specific Dashboard -->
                    @if ($role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Dashboard</a>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Admin Panel</a>
                    @elseif ($role === 'medewerker')
                        <a href="{{ route('medewerker.dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Dashboard</a>
                        <a href="{{ route('medewerker.dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Medewerker Panel</a>
                    @elseif ($role === 'bezoeker')
                         <a href="{{ route('bezoeker.dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Mijn Tickets</a>
                    @endif

                    <!-- Profile Link -->
                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-indigo-600 transition duration-150">Profiel</a>
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150">Logout</button>
                    </form>
                @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 transition duration-150">Login</a>
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 transition duration-150">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>