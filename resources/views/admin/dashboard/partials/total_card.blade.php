<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @foreach ($cards as $card)
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center">
                <span class="mr-3">
                    <i class="{{ $card['icon'] }} {{ $card['color'] }} text-xl p-2 rounded"></i>
                </span>
                <h5 class="text-lg font-medium text-gray-700">{{ $card['title'] }}</h5>
            </div>
            <div class="px-6 py-8 flex items-center justify-center">
                <p class="text-3xl font-bold text-indigo-600">{{ $card['count'] }}</p>
            </div>
        </div>
    @endforeach           
</div>