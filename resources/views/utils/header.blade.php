<nav id="navbar" class="fixed top-0 left-0 w-full z-50 bg-[var(--blue-dark)] transition-all duration-300 text-white">
    <div class="container mx-auto px-6 md:px-10 py-3 sm:py-4 flex justify-between items-center">
        <a href="{{ route('homepage') }}" class="flex-shrink-0">
            <img src="{{ asset('logo.png') }}" alt="Find My Major Logo"
                class="block h-10 sm:h-12 md:h-12 lg:h-12 w-auto">
        </a>

        <div class="flex items-center space-x-3 md:space-x-8">
            <a href="{{ route('homepage') }}"
                class="hidden sm:flex items-center justify-center space-x-1.5 text-sm md:text-base hover:text-[var(--primary)] font-semibold transition-colors duration-200 px-2 py-1">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>

            <a href="{{ route('majors.index') }}"
                class="hidden sm:flex items-center justify-center space-x-1.5 text-sm md:text-base hover:text-[var(--primary)] font-semibold transition-colors duration-200 px-2 py-1">
                <i class="fa-solid fa-book"></i>
                <span>Info Jurusan</span>
            </a>

            <a href="{{ route('testimonials.index') }}"
                class="hidden sm:flex items-center justify-center space-x-1.5 text-sm md:text-base hover:text-[var(--primary)] font-semibold transition-colors duration-200 px-2 py-1">
                <i class="fa-solid fa-person"></i>
                <span>Community</span>
            </a>

            @auth
            {{-- Pengguna sudah login --}}
            <a href="{{ route('ai.mate.index') }}"
                class="flex items-center justify-center space-x-1.5 text-sm md:text-base bg-[var(--primary)] rounded-lg px-3 py-1.5 hover:bg-[var(--light-orange)] hover:text-white font-semibold transition-colors duration-200">
                <i class="fa-solid fa-robot"></i>
                <span>AI Mate</span>
            </a>

            <div class="relative ml-4">
                <button id="profileButton" onclick="toggleProfileDropdown()" class="flex items-center text-sm font-medium hover:text-[var(--primary)] focus:outline-none transition duration-150 ease-in-out">
                    <div class="truncate max-w-[100px] md:max-w-[150px]">{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                <div id="profileDropdown" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden origin-top-right py-1 z-50">
                    <div class="px-4 py-2 text-xs text-gray-400">
                        Signed in as {{ Auth::user()->email }}
                    </div>
                    <hr class="border-gray-200">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profile Settings</a>
                    {{-- Jika ada halaman dashboard khusus untuk user (selain chatbot) --}}
                    {{-- <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Dashboard</a> --}}
                    @if(Auth::user()->is_admin ?? false) {{-- Contoh jika ada role admin --}}
                    <a href="{{-- route('admin.dashboard') --}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Admin Panel</a>
                    @endif
                    <hr class="border-gray-200">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
            @else
            {{-- Pengguna adalah guest --}}
            <a href="{{ route('login') }}" class="text-sm md:text-base font-medium hover:text-[var(--primary)] transition-colors duration-200 px-2 py-1">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-sm md:text-base bg-[var(--primary)] rounded-lg px-3 py-1.5 hover:bg-[var(--light-orange)] hover:text-white font-semibold transition-colors duration-200">
                Register
            </a>
            @endif
            @endauth
        </div>
    </div>
</nav>