@extends('admin.layout.master')
@section('title', 'Dashboard')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-6">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-xl font-semibold text-gray-800">Dashboard</h4>
                </div>
                <div class="px-6 py-4">
                    <p class="text-gray-700">Welcome to the admin dashboard!</p>
                    <p class="text-gray-500">Here you can manage your products, orders, and customers.</p>
                </div>
            </div>
        </div>
        @include('admin.dashboard.partials.total_card', $cards)
    </div>
@endsection