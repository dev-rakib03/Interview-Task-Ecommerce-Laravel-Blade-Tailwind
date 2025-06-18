@foreach ($products as $product)
     <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
         <img src="{{ asset('storage/'.$product->thumbnail) }}" onerror="this.src='{{ asset('img/default.jpg') }}'" alt="{{ $product->name }}"
             class="rounded mb-4 object-cover h-40 w-full">
         <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
         <div class="mt-auto flex items-center justify-between">
             <span class="text-xl font-bold text-indigo-600">৳ {{ $product->price }}</span>
             <a href="{{route('frontend.product.show',$product->slug)}}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">View</a>
         </div>
     </div>
 @endforeach
