@extends('admin.layout.master')
@section('title', 'Categories')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.tailwindcss.css">
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6 bg-white">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Categories</h1>
            <button id="addCategoryBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
                Category</button>
        </div>
        <div>
            <table id="categories-table" class="display" data-href="{{ route('admin.category.index') }}">
                <thead>
                    <tr>
                        <th class="w-1/10">SL</th>
                        <th>Name</th>
                        <th class="w-1/6">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Add Category Modal --}}
    @include('admin.category.partials.add_modal')

    {{-- Edit Category Modal --}}
    @include('admin.category.partials.edit_modal')

    {{-- Delete Confirm Modal --}}
    @include('admin.category.partials.delete_modal')
@endsection

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.tailwindcss.js"></script>
    <script src="{{ asset('admin/js/category.js') }}"></script>
@endsection
