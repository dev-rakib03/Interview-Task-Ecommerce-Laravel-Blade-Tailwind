<aside id="sidebar"
    class="fixed top-18 md:top-0 left-0 w-64 h-screen bg-white text-gray-700 p-4 space-y-4 z-20 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out shadow-lg">
    <nav class="space-y-2">
        <div class="text-center mb-8 hidden md:block">
            <h1
                class="text-xl text-blue-600 font-bold rounded-lg bg-white/30 backdrop-blur-md shadow px-4 py-2">
                {{ env('APP_NAME') }}
            </h1>
        </div>
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center p-2 hover:bg-gray-100 rounded {{ Route::is('admin.dashboard') ? 'bg-gray-200 font-bold' : '' }}">
            <i class="fas fa-tachometer-alt w-5 mr-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.category.index') }}"
            class="flex items-center p-2 hover:bg-gray-100 rounded {{ Route::is('admin.category.*') ? 'bg-gray-200 font-bold' : '' }}">
            <i class="fas fa-tags w-5 mr-2"></i> Categories
        </a>
        <div>
            @php
                $productActive = Route::is('admin.product.*');
            @endphp
            <button id="toggleProductMenu"
                class="flex justify-between items-center w-full p-2 hover:bg-gray-100 rounded focus:outline-none {{ $productActive ? 'bg-gray-200 font-bold' : '' }}">
                <span class="flex items-center">
                    <i class="fas fa-box w-5 mr-2"></i> Products
                </span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div id="productSubMenu" class="ml-6 mt-2 {{ $productActive ? '' : 'hidden' }} space-y-2">
                <a href="{{ route('admin.product.index') }}"
                    class="block p-2 hover:bg-gray-100 rounded {{ Route::is('admin.product.*') && !Route::is('admin.product.create') ? 'bg-gray-200 font-bold' : '' }}">All
                    Products</a>
                <a href="{{ route('admin.product.create') }}"
                    class="block p-2 hover:bg-gray-100 rounded {{ Route::is('admin.product.create') ? 'bg-gray-200 font-bold' : '' }}">Add
                    Product</a>
            </div>
        </div>
    </nav>
</aside>
