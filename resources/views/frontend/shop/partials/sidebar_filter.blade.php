<aside id="mobile-filter"
    class="md:w-1/4 w-full min-h-screen mb-8 md:mb-0 bg-white rounded shadow p-6 h-full md:block hidden">
    <h3 class="text-xl font-semibold mb-4">Filter</h3>
    <div class="mb-4">
        <label class="block text-lg font-medium mb-1" for="category">Category</label>
        <ul class="ml-4 max-h-screen overflow-y-auto">
            @foreach ($categories as $category)
                <li class="{{ request()->category == $category->id ? 'bg-gray-100' : '' }} p-1 rounded-lg mb-1 cursor-pointer hover:bg-gray-100 category-filter"
                    data-category="{{ $category->id }}">
                    <i class="fas fa-arrow-right"></i> {{ $category->name }}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="price">Price Range</label>
        <div class="flex items-center space-x-2">
            <input type="number" id="min-price-input" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                value="{{ $minPrice }}" class="w-20 border rounded px-2 py-1 text-gray-700" />
            <span class="mx-1">-</span>
            <input type="number" id="max-price-input" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                value="{{ $maxPrice }}" class="w-20 border rounded px-2 py-1 text-gray-700" />
        </div>
        <input type="range" id="price-range" name="price" min="{{ $minPrice }}"
            max="{{ $maxPrice }}" value="{{ $maxPrice }}" class="w-full accent-blue-600 mt-2">
    </div>

    <button class="md:hidden mt-4 px-4 py-2 bg-gray-200 text-gray-700 rounded w-full"
        onclick="document.getElementById('mobile-filter').classList.add('hidden')">
        Close
    </button>
</aside>
