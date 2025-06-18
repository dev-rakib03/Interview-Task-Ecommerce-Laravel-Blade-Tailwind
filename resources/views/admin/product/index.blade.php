@extends('admin.layout.master')
@section('title', 'Products')

@section('meta')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.tailwindcss.css">
    <style>
        .dt-empty {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6 bg-white ">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Products</h1>
            <a href="{{ route('admin.product.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Product</a>
        </div>
        <div>
            <table id="products-table" class="display" data-href="{{ route('admin.product.index') }}">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SL</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Thumbnail</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Categories</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SL</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Thumbnail</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Categories</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Delete Confirm Modal --}}
    @include('admin.product.partials.delete_modal')
@endsection

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.tailwindcss.js"></script>
    <script src="{{ asset('admin/js/product.js') }}"></script>
@endsection
