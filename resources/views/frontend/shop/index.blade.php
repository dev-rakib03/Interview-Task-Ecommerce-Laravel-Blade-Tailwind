@extends('frontend.layout.master')
@section('title', 'Shop')
@section('meta')
    {{-- If need any Custom meta for this page specefic --}}
    <meta name="title" content="Test E-commerce Home Page">
    <meta name="description"
        content="Welcome to our e-commerce platform. Explore a wide range of products and enjoy a seamless shopping experience.">
    <meta name="keywords" content="e-commerce, online shopping, products, deals">
@endsection

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">Products</h2>
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Sidebar Filter --}}

            <button class="md:hidden mb-4 px-4 py-2 bg-blue-600 text-white rounded font-semibold flex items-center gap-2"
                onclick="$('#mobile-filter').toggleClass('hidden')" aria-controls="mobile-filter" aria-expanded="false">
                <i class="fas fa-filter"></i> Filter
            </button>

            @include('frontend.shop.partials.sidebar_filter')

            <div class="md:w-3/4 w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8" id="all-products"
                    data-href="{{ route('frontend.product.list') }}">
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('admin/js/shop.js') }}"></script>
@endsection
