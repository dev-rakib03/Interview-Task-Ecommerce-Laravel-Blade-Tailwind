@extends('frontend.layout.master')
@section('title', $product->name ?? 'Product')
@section('meta')
    {{-- If need any Custom meta for this page specific --}}
    <meta name="title" content="{{ $product->name }} | {{ env('APP_NAME') }}">
    <meta name="description" content="{{ Str::limit(strip_tags($product->description), 160) }}">
    <meta name="keywords" content="{{ implode(', ', $product->categories->pluck('name')->toArray()) }}, e-commerce, online shopping, products">
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <style>
        .owl-theme .owl-nav [class*='owl-'] {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #333;
            margin: 0 10px;
        }

        .owl-theme .owl-dots .owl-dot span {
            background: #ccc;
        }

        .owl-theme .owl-dots .owl-dot.active span {
            background: #1f2937;
        }
    </style>

@endsection
@section('content')
    {{-- Product Grid --}}
    <section class="max-w-7xl mx-auto px-4 py-12 min-h-screen">
        <div class="flex flex-col md:flex-row gap-8">
            @php
                $allImages = array_merge(
                    [$product->thumbnail],
                    $product->images ? json_decode($product->images, true) : [],
                );
            @endphp

            <div class="w-full md:w-1/2 mx-auto">
                <div class="relative group border border-gray-300 rounded-lg overflow-hidden shadow-lg">
                    <div id="main-carousel" class="owl-carousel owl-theme">
                        @foreach ($allImages as $img)
                            <div class="item">
                                <img src="{{ asset('storage/' . $img) }}"
                                    onerror="this.src='{{ asset('img/default.jpg') }}'" alt="Product Image"
                                    class="w-full h-80 object-contain rounded shadow transition-transform duration-300 group-hover:scale-105">
                            </div>
                        @endforeach
                    </div>
                    <button
                        class="w-10 border border-gray-500 cursor-pointer ml-2 absolute left-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/80 hover:bg-white rounded-full shadow"
                        onclick="$('#main-carousel').trigger('prev.owl.carousel')">
                        &#10094;
                    </button>
                    <button
                        class="w-10 border border-gray-500 cursor-pointer mr-2 absolute right-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/80 hover:bg-white rounded-full shadow"
                        onclick="$('#main-carousel').trigger('next.owl.carousel')">
                        &#10095;
                    </button>
                </div>
                <div id="thumb-carousel" class="owl-carousel owl-theme mt-4">
                    @foreach ($allImages as $img)
                        <div class="item cursor-pointer">
                            <img src="{{ asset('storage/' . $img) }}" onerror="this.src='{{ asset('img/default.jpg') }}'"
                                alt="Thumbnail"
                                class="w-20 h-20 object-cover rounded border hover:scale-105 transition duration-300">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="md:w-1/2 flex flex-col gap-4">
                <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
                <div class="flex flex-wrap gap-2">
                    @foreach ($product->categories as $category)
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                    @endforeach
                </div>
                <div class="text-xl text-green-600 font-semibold">Price: ৳{{ number_format($product->price, 2) }}</div>
                <div class="text-gray-700">SKU: <span class="font-mono">{{ $product->sku }}</span></div>
                <div class="text-gray-700">Status:
                    <span
                        class="px-2 py-1 rounded {{ $product->status == 'public' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($product->status) }}
                    </span>
                </div>

            </div>

        </div>
        <div class="w-full">
            <div class="mt-4">
                <h2 class="text-lg font-semibold mb-2">Description</h2>
                <div class="prose max-w-none">{!! $product->description !!}</div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('admin/js/product-show.js') }}"></script>
@endsection
