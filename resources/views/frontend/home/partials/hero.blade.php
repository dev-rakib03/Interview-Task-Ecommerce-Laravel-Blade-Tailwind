    <div class="relative w-full mx-auto">
        <div class="overflow-hidden shadow-lg relative">
            <div class="carousel flex transition-transform duration-700" id="hero-carousel">
                <div class="min-w-full">
                    <img src="https://cdn.vectorstock.com/i/500p/57/56/shopping-cart-banner-online-store-vector-42935756.jpg"
                        onerror="this.src='{{ asset('img/default.jpg') }}'" class="w-full h-100 object-cover"
                        alt="Slide 3">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                        <h2 class="text-3xl md:text-5xl font-bold text-white">Step Up Your Style</h2>
                    </div>
                </div>
                <div class="min-w-full">
                    <img src="https://cdn.vectorstock.com/i/500p/57/56/shopping-cart-banner-online-store-vector-42935756.jpg"
                        onerror="this.src='{{ asset('img/default.jpg') }}'" class="w-full h-100 object-cover"
                        alt="Slide 3">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                        <h2 class="text-3xl md:text-5xl font-bold text-white">Step Up Your Style</h2>
                    </div>
                </div>
            </div>
            <button id="prev-slide"
                class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 hover:bg-opacity-100 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="next-slide"
                class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 hover:bg-opacity-100 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
