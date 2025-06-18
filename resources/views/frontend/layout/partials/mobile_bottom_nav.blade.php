<nav class="fixed bottom-1 left-0 w-full bg-white shadow md:hidden border z-52 rounded-full">
    <div class="flex justify-around text-sm text-gray-700">
        <a href="{{ route('frontend.home') }}" class="flex flex-col items-center py-2">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            Home
        </a>
        <button id="openCategories" type="button" class="flex flex-col items-center py-2 focus:outline-none">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 13V7a1 1 0 00-1-1h-5V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v2H5a1 1 0 00-1 1v6m16 0v6a1 1 0 01-1 1h-5v-4h-4v4H5a1 1 0 01-1-1v-6" />
            </svg>
            Categories
        </button>
        <a href="#" class="flex flex-col items-center py-2">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" fill="none"/>
                <line x1="16.5" y1="16.5" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Search
        </a>
        <a href="{{ route('frontend.shop') }}" class="flex flex-col items-center py-2">
            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 11h14l-1.68 9.39A2 2 0 0115.36 22H8.64a2 2 0 01-1.96-1.61L5 11z" />
            </svg>
            Shop
        </a>
    </div>
</nav>

<div id="categoriesModal" class="fixed left-0 w-full bg-opacity-40 z-50 hidden" style="bottom: 70px;">
    <div class="bg-white w-full rounded-xl p-4 max-h-80 overflow-y-auto mx-auto shadow-xl border-t border-gray-500 border-2"
         style="transform: translateY(100%); transition: transform 0.3s;">
        <div class="flex justify-between items-center mb-4">
            <span class="font-bold text-lg">Categories</span>
            <button id="closeCategories" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <ul>
            @foreach ($categories as $category)
                <li class="w-full">
                    <a href="{{ route('frontend.shop',['category'=>$category->id]) }}">
                        <div class="w-full bg-gray-100 mb-1 rounded-lg p-2">
                            <i class="fas fa-arrow-right"></i> {{ $category->name }}
                        </div>
                    </a>
                </li>
            @endforeach           
        </ul>
    </div>
</div>
