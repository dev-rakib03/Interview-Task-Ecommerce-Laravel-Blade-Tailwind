@extends('admin.layout.master')
@section('title', 'Edit Product')

@section('content')
    <div class="container mx-auto px-4 py-6 bg-white ">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Edit Product</h1>
            <a href="{{ route('admin.product.index') }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700"><i class="fas fa-arrow-left"></i>
                Back</a>
        </div>
        <div>
            <div>
                <form id="productForm" enctype="multipart/form-data" action="{{ route('admin.product.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold mb-3">Basic Information</h2>
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full md:w-1/2 px-2 mb-4">
                                <label class="block mb-1 font-semibold">Product Name</label>
                                <input type="text" name="name"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none"
                                    value="{{ old('name', $product->name) }}" />
                                <span class="text-red-500 text-sm error-text" data-error="name"></span>
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-4">
                                <label class="block mb-1 font-semibold">Categories</label>
                                <select name="categories[]" multiple
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if(collect(old('categories', $product->categories->pluck('id')->toArray()))->contains($category->id)) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-red-500 text-sm error-text" data-error="categories"></span>
                            </div>
                            <div class="w-full md:w-1/3 px-2 mb-4">
                                <label class="block mb-1 font-semibold">Price</label>
                                <input type="number" step="0.01" name="price"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none"
                                    value="{{ old('price', $product->price) }}" />
                                <span class="text-red-500 text-sm error-text" data-error="price"></span>
                            </div>
                            <div class="w-full md:w-1/3 px-2 mb-4">
                                <label class="block mb-1 font-semibold">SKU</label>
                                <input type="text" name="sku"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none"
                                    value="{{ old('sku', $product->sku) }}" />
                                <span class="text-red-500 text-sm error-text" data-error="sku"></span>
                            </div>
                            <div class="w-full md:w-1/3 px-2 mb-4">
                                <label class="block mb-1 font-semibold">Status</label>
                                <select name="status"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                    <option value="public" {{ old('status', $product->status) == 'public' ? 'selected' : '' }}>Public</option>
                                    <option value="hidden" {{ old('status', $product->status) == 'hidden' ? 'selected' : '' }}>Hidden</option>
                                </select>
                                <span class="text-red-500 text-sm error-text" data-error="status"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-lg font-semibold mb-3">Product Information</h2>
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full px-2 mb-4">
                                <label class="block mb-1 font-semibold">Description</label>
                                <textarea name="description" id="descriptionEditor"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">{{ old('description', $product->description) }}</textarea>
                                <span class="text-red-500 text-sm error-text" data-error="description"></span>
                            </div>
                            <div class="w-full md:w-1/3 px-2 mb-4">
                                <label class="block mb-1 font-semibold">Thumbnail</label>
                                <input type="file" name="thumbnail" accept="image/*"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none"
                                    id="thumbnailInput" />
                                <span class="text-red-500 text-sm error-text" data-error="thumbnail"></span>
                                @if($product->thumbnail)
                                    <img id="thumbnailPreview" src="{{ asset('storage/' . $product->thumbnail) }}" class="mt-2 h-24" />
                                @else
                                    <img id="thumbnailPreview" class="mt-2 h-24" style="display:none;" />
                                @endif
                            </div>
                            <div class="w-full md:w-2/3 px-2 mb-4">
                                <label class="block mb-1 font-semibold">Images</label>
                                <input type="file" name="images[]" accept="image/*" multiple
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none"
                                    id="imagesInput" />
                                <span class="text-red-500 text-sm error-text" data-error="images"></span>
                                <div id="imagesPreview" class="flex flex-wrap gap-2 mt-2">
                                    @php
                                        $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                                    @endphp
                                    @if($images && count($images))
                                        @foreach($images as $image)
                                            <img src="{{ asset('storage/' . (is_array($image) && isset($image['path']) ? $image['path'] : $image)) }}" class="h-16 rounded" />
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('admin/js/product-edit.js') }}"></script>
@endsection
