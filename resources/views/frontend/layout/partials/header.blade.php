<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="text-xl font-bold">{{ env('APP_NAME') }}</div>

        <nav class="hidden md:flex items-center gap-6">
            <a href="{{ route('frontend.home') }}" class="text-gray-700 hover:text-black"><i class="fas fa-home"></i>
                Home</a>
            <a href="{{ route('frontend.shop') }}" class="text-gray-700 hover:text-black"><i class="fas fa-shop"></i>
                Shop</a>
            <a href="#" class="text-gray-700 hover:text-black"><i class="fas fa-info-circle"></i> About</a>
            <a href="#" class="text-gray-700 hover:text-black"><i class="fas fa-envelope"></i> Contact</a>
            <div class="relative">
                <button id="categoryToggle" class="flex items-center gap-1 text-gray-700 hover:text-black">
                    <i class="fas fa-th-large"></i> Categories
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="categoryDropdown"
                    class="absolute left-0 mt-2 w-64 max-h-88 bg-white rounded shadow-xl hidden z-52 p-4 overflow-y-auto">
                    @foreach ($categories as $category)
                        <a href="{{ route('frontend.shop', ['category' => $category->id]) }}">
                            <div class="w-full bg-gray-100 mb-1 rounded-lg p-2">
                                <i class="fas fa-arrow-right"></i> {{ $category->name }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <a href="#" class="text-gray-700 hover:text-black flex items-center">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="#" class="text-gray-700 hover:text-black flex items-center">
                <i class="fas fa-user"></i>
            </a>
        </nav>

        <div class="md:hidden flex gap-4">
            <a href="#" class="text-gray-700 hover:text-black flex items-center">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="#" class="text-gray-700 hover:text-black flex items-center">
                <i class="fas fa-user"></i>
            </a>
            <button id="mobileMenuToggle" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobileMenu" class="md:hidden hidden px-4 pb-4">
        <a href="{{ route('frontend.home') }}" class="block py-2 border-b"><i class="fas fa-home"></i> Home</a>
        <a href="#" class="block py-2 border-b"><i class="fas fa-info-circle"></i> About</a>
        <a href="#" class="block py-2 border-b"><i class="fas fa-envelope"></i> Contact</a>
    </div>
</header>
