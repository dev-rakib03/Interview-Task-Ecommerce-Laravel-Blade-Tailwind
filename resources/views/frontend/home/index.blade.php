@extends('frontend.layout.master')
@section('title', env('APP_NAME') . ' - Home')
@section('meta')
    {{-- If need any Custom meta for this page specefic --}}
    <meta name="title" content="Test E-commerce Home Page">
    <meta name="description"
        content="Welcome to our e-commerce platform. Explore a wide range of products and enjoy a seamless shopping experience.">
    <meta name="keywords" content="e-commerce, online shopping, products, deals">
@endsection
@section('css')
@endsection
@section('content')

    @include('frontend.home.partials.hero')

    {{-- Product Grid --}}
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="all-products" data-href="{{ route('frontend.product.list') }}">
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('admin/js/home.js') }}"></script>
@endsection
