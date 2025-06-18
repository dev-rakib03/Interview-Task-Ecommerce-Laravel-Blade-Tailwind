<header class="fixed top-0 left-0 right-0 bg-white text-blue-600 px-4 py-3 md:ml-64 z-30 md:min-h-16 flex items-center" style="box-shadow: 4px 4px 4px 0 rgba(0,0,0,0.05), 2px 0 0 0 transparent;">
    <div class="flex justify-between items-center w-full">
        <div>
            <h1 class="text-xl text-blue-600 font-bold rounded-lg bg-white/30 backdrop-blur-md shadow px-4 py-2 md:hidden">
                {{ env('APP_NAME') }}
            </h1>
        </div>
        <div class="flex items-center space-x-4">
            <nav class="md:flex space-x-4">
                <a href="{{ route('frontend.home') }}" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-shop"></i> Store
                </a>                    
            </nav>
            <button id="toggleSidebar" class="md:hidden text-gray-500 text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
